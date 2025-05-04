<?php
ob_start();
session_start();
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
if (!isset($_SESSION['id'])) {
    header('location:index.php');
    exit;
}
$user_id = $_SESSION['id'];

// Naive Bayes Classifier dynamic tranning model ho yo chai databse 
class EnhancedNaiveBayesClassifier {
    private $specializations = [];
    private $vocabulary = [];
    private $classCounts = [];
    private $knownSymptoms = [];
    private $symptomFrequency = [];
    private $totalDocuments = 0;

    public function trainModel($conn) {
        $this->specializations = $this->vocabulary = $this->classCounts = $this->knownSymptoms = $this->symptomFrequency = [];
        $this->totalDocuments = 0;
        $result = $conn->query("SELECT specialization, symptoms FROM specialization");
        while ($row = $result->fetch_assoc()) {
            $class = trim($row['specialization']);
            $tokens = $this->preprocessText($row['symptoms']);
            $this->specializations[$class] = array_merge($this->specializations[$class] ?? [], $tokens);
            $this->classCounts[$class] = ($this->classCounts[$class] ?? 0) + 1;
            $this->totalDocuments++;
            foreach ($tokens as $t) {
                $this->vocabulary[$t] = ($this->vocabulary[$t] ?? 0) + 1;
                $this->symptomFrequency[$class][$t] = ($this->symptomFrequency[$class][$t] ?? 0) + 1;
            }
        }
        $this->knownSymptoms = array_keys($this->vocabulary);
    }
    private function preprocessText($text) {
        $text = strtolower($text);
        $text = preg_replace("/[^a-z0-9\s]/i","",$text);
        $tokens = preg_split('/\s+/', trim($text));
        $stop = ['and','the','or','is','of','in','to','with','a','an'];
        return array_values(array_diff($tokens, $stop));
    }
    private function correctSpelling($w) {
        $shortest = -1; $closest = $w;
        foreach ($this->knownSymptoms as $d) {
            $lev = levenshtein($w,$d);
            if ($lev===0) return $d;
            if ($lev<=2 && ($lev<$shortest||$shortest<0)) {
                $closest=$d; $shortest=$lev;
            }
        }
        return ($shortest<=2)?$closest:$w;
    }
    public function predict($input, &$corrected=[], &$conf=[]) {
        $tokens = $this->preprocessText($input);
        $corrected = array_unique(array_map([$this,'correctSpelling'],$tokens));
        $vsize = count($this->vocabulary);
        $scores=[];
        foreach ($this->specializations as $cls=>$_) {
            $prior = $this->classCounts[$cls]/$this->totalDocuments;
            $logP = log($prior);
            $totalCount = array_sum($this->symptomFrequency[$cls]);
            foreach ($corrected as $tk) {
                $cnt = $this->symptomFrequency[$cls][$tk] ?? 0;
                $logP += log(($cnt+1)/($totalCount+$vsize));
            }
            $scores[$cls] = $logP;
        }
        $max = max($scores); $sum=0;
        foreach ($scores as $cls=>$sc) {
            $scores[$cls]=exp($sc-$max);
            $sum += $scores[$cls];
        }
        foreach ($scores as $cls=>$sc) {
            $conf[$cls] = $sum>0?($sc/$sum)*100:0;
        }
        arsort($conf);
        return array_key_first($conf);
    }
}

// Initialize classifier and train
$classifier = new EnhancedNaiveBayesClassifier();
$classifier->trainModel($conn);

$userInput = "";
$prediction = "";
$availableDoctors = [];
$doctorAvailable = false;
$correctedSymptoms = [];
$confidenceScores = [];

// Handle form submission and recommendation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['symptom'])) {
    $userInput = trim($_POST['symptom']);
    $prediction = $classifier->predict($userInput, $correctedSymptoms, $confidenceScores);
    $candidates = array_keys($confidenceScores);
    foreach (array_slice($candidates, 0, 3) as $specName) {
        $stmtSpec = $conn->prepare("SELECT id FROM specialization WHERE specialization = ?");
        $stmtSpec->bind_param("s", $specName);
        $stmtSpec->execute();
        $specRes = $stmtSpec->get_result()->fetch_assoc();
        if (!$specRes) continue;
        $stmt = $conn->prepare("
            SELECT 
              d.id AS doc_id,
              d.first_name,
              d.last_name,
              s.specialization
            FROM doctors d
            INNER JOIN specialization s ON d.specialization = s.id
            WHERE d.specialization = ?
        ");
        $stmt->bind_param("i", $specRes['id']);
        $stmt->execute();
        $docs = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        if (!empty($docs)) {
            $availableDoctors = $docs;
            $prediction       = $specName;
            $doctorAvailable  = true;
            break;
        }
    }
}
if (empty($userInput)) {
    $res = $conn->query("
        SELECT 
          d.id AS doc_id,
          d.first_name,
          d.last_name,
          s.specialization
        FROM doctors d
        LEFT JOIN specialization s ON d.specialization = s.id
    ");
    $availableDoctors = $res->fetch_all(MYSQLI_ASSOC);
    $doctorAvailable  = !empty($availableDoctors);
}
?>

<div class="container-fluid">
  <div class="card mb-4">
    <div class="card-header"><h6>Search Doctor By Symptom</h6></div>
    <div class="card-body">
      <form method="POST">
        <div class="form-row">
          <div class="col-md-8">
            <input type="text" name="symptom" class="form-control" placeholder="e.g. fever, chest pain"
                   value="<?php echo htmlspecialchars($userInput); ?>" required>
          </div>
          <div class="col-md-4">
            <button class="btn btn-primary">Search</button>
            <a href="?" class="btn btn-secondary">Reset</a>
          </div>
        </div>
      </form>
      <?php if ($userInput): ?>
        <div class="alert alert-success mt-3">
          Recommended Specialization: <strong><?php echo htmlspecialchars($prediction); ?></strong>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <div class="card mb-4">
    <div class="card-header">
      <h6><?php echo $userInput
               ? "Doctors for: ".htmlspecialchars($prediction)
               : "All Available Doctors"; ?></h6>
    </div>
    <div class="card-body">
      <?php if ($doctorAvailable): ?>
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr><th>#</th><th>Name</th><th>Specialization</th><th>Action</th></tr>
            </thead>
            <tbody>
              <?php $sn=1; foreach($availableDoctors as $d): ?>
                <tr>
                  <td><?php echo $sn++; ?></td>
                  <td><?php echo htmlspecialchars($d['first_name'].' '.$d['last_name']); ?></td>
                  <td><?php echo htmlspecialchars($d['specialization']); ?></td>
                  <td>
                    <form action="appointment_list.php" method="POST">
                      <input type="hidden" name="doctor_id" value="<?php echo $d['doc_id']; ?>">
                      <a href="appointment_list.php?doctor_id=<?php echo $doctor['doc_id']; ?>" class="btn btn-primary">Book Appointment</a>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php else: ?>
        <div class="alert alert-danger">Sorry, no doctors available for this specialization.</div>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php include("includes/footer.php"); ?>
