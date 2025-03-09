DROP TABLE IF EXISTS about_page;

CREATE TABLE `about_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_title` varchar(255) NOT NULL,
  `page_description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTOabout_page VALUES("1","About Our Hospital","Our Hospital Management System (HMS) is a cutting-edge software solution designed to streamline the operations of hospitals, clinics, and healthcare centers. It aims to simplify administrative tasks, enhance efficiency, and improve overall patient care.

With our system, healthcare facilities can efficiently manage patient registration, appointments, billing, medical records, inventory, and generate reports. It reduces the manual workload and minimizes errors, allowing healthcare professionals to focus more on patient care.The system is built with security and data privacy as top priorities, ensuring all patient information is protected. Our HMS is user-friendly and customizable to meet the unique needs of each healthcare provider, improving service delivery and enabling better decision-making.","2024-11-15 14:04:21");


DROP TABLE IF EXISTS accountant;

CREATE TABLE `accountant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `qualification` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTOaccountant VALUES("1","31","9800098765","KTM","male","Bachelor Pass");


DROP TABLE IF EXISTS activity_log;

CREATE TABLE `activity_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `status` enum('active','unactive') DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=537 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTOactivity_log VALUES("535","27","admin","active","172.19.96.1","2025-03-02 05:03:28");
INSERT INTOactivity_log VALUES("536","27","admin","active","172.19.96.1","2025-03-02 05:09:25");


DROP TABLE IF EXISTS appointments;

CREATE TABLE `appointments` (
  `app_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `status` enum('confirmed','completed','cancel') NOT NULL DEFAULT 'confirmed',
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`app_id`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTOappointments VALUES("102","30","13","completed","2025-01-29","09:42:00");
INSERT INTOappointments VALUES("106","28","17","completed","2025-01-30","10:55:00");
INSERT INTOappointments VALUES("109","23","17","completed","2025-01-29","12:30:00");
INSERT INTOappointments VALUES("111","39","17","completed","2025-02-19","09:52:00");


DROP TABLE IF EXISTS bed;

CREATE TABLE `bed` (
  `bed_id` int(11) NOT NULL AUTO_INCREMENT,
  `bed_num` varchar(10) NOT NULL,
  `bed_type` varchar(10) NOT NULL,
  `description` text NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`bed_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTObed VALUES("27","100","w2","General ward","2025-01-21","2025-01-21");
INSERT INTObed VALUES("29","101","General","Description","2025-01-29","2025-01-29");
INSERT INTObed VALUES("30","102","Single","Description","2025-01-29","2025-01-29");
INSERT INTObed VALUES("31","103","ICU","Descriptiion","2025-01-29","2025-01-29");
INSERT INTObed VALUES("32","104","Double","Description","2025-01-29","2025-01-29");


DROP TABLE IF EXISTS bed_allocate;

CREATE TABLE `bed_allocate` (
  `bed_allocate_id` int(11) NOT NULL AUTO_INCREMENT,
  `bed_id` int(11) DEFAULT NULL,
  `pateint_id` int(11) DEFAULT NULL,
  `allocated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `discharge` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`bed_allocate_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTObed_allocate VALUES("6","10","7","2024-11-28 08:45:43","2024-12-05 08:45:43");
INSERT INTObed_allocate VALUES("7","11","5","2003-11-29 01:00:54","2024-11-28 09:22:54");
INSERT INTObed_allocate VALUES("8","0","0","0000-00-00 00:00:00","0000-00-00 00:00:00");
INSERT INTObed_allocate VALUES("9","19","18","2025-02-12 02:52:00","2025-01-14 05:53:00");
INSERT INTObed_allocate VALUES("10","25","19","2025-01-16 17:38:00","2025-01-18 17:41:00");
INSERT INTObed_allocate VALUES("11","26","20","2025-01-21 15:37:00","2025-01-21 16:38:00");
INSERT INTObed_allocate VALUES("15","26","21","2025-01-24 07:09:00","2025-01-31 08:10:00");
INSERT INTObed_allocate VALUES("17","27","28","2025-01-28 11:07:00","2025-01-31 09:09:00");
INSERT INTObed_allocate VALUES("18","29","23","2025-01-30 16:05:00","2025-01-31 04:07:00");


DROP TABLE IF EXISTS billing;

CREATE TABLE `billing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appointment_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_status` enum('Paid','Pending') DEFAULT 'Pending',
  `payment_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `appointment_id` (`appointment_id`),
  CONSTRAINT `billing_ibfk_1` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`app_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



DROP TABLE IF EXISTS blog;

CREATE TABLE `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_title` varchar(255) NOT NULL,
  `blog_des` text NOT NULL,
  `category` varchar(255) NOT NULL,
  `tag` varchar(255) NOT NULL,
  `image_1` varchar(255) NOT NULL,
  `image_2` varchar(255) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTOblog VALUES("2","Lorem ipsum dolor sit amet consectetur, adipisicing elit. Delectus itaque quo veritatis aliquid voluptates animi?","Lorem ipsum dolor sit, amet consectetur adipisicing elit. Consectetur mollitia, pariatur temporibus dolore porro sint aperiam ullam dolores ipsam exercitationem blanditiis error nisi nemo, architecto voluptatem quidem. Recusandae sit voluptatibus cum porro ad eius tempore modi a possimus aperiam mollitia reprehenderit est, earum nulla dolorem tenetur iusto, rerum omnis, error non quos asperiores nostrum obcaecati. Dolorum, quos obcaecati sunt, consequatur quo aperiam consequuntur voluptates vitae, nostrum fuga nihil. Itaque iste vero, aliquam tempora voluptatem quas dolore, quasi ratione autem iure iusto rem vitae expedita velit consectetur aliquid reprehenderit qui ipsum commodi ipsam recusandae distinctio. Minima reprehenderit ipsa nesciunt commodi ab.\\r\\n\\r\\nLorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis, numquam!\\r\\nLorem ipsum dolor sit, amet consectetur adipisicing elit. Consectetur mollitia, pariatur temporibus dolore porro sint aperiam ullam dolores ipsam exercitationem blanditiis error nisi nemo, architecto voluptatem quidem. Recusandae sit voluptatibus cum porro ad eius tempore modi a possimus aperiam mollitia reprehenderit est, earum nulla dolorem tenetur iusto, rerum omnis, error non quos asperiores nostrum obcaecati. Dolorum, quos obcaecati sunt, consequatur quo aperiam consequuntur voluptates vitae, nostrum fuga nihil. Itaque iste vero, aliquam tempora voluptatem quas dolore, quasi ratione autem iure iusto rem vitae expedita velit consectetur aliquid reprehenderit qui ipsum commodi ipsam recusandae distinctio. Minima reprehenderit ipsa nesciunt commodi ab.\\r\\n\\r\\nLorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis, numquam!\\r\\nLorem ipsum dolor sit, amet consectetur adipisicing elit. Consectetur mollitia, pariatur temporibus dolore porro sint aperiam ullam dolores ipsam exercitationem blanditiis error nisi nemo, architecto voluptatem quidem. Recusandae sit voluptatibus cum porro ad eius tempore modi a possimus aperiam mollitia reprehenderit est, earum nulla dolorem tenetur iusto, rerum omnis, error non quos asperiores nostrum obcaecati. Dolorum, quos obcaecati sunt, consequatur quo aperiam consequuntur voluptates vitae, nostrum fuga nihil. Itaque iste vero, aliquam tempora voluptatem quas dolore, quasi ratione autem iure iusto rem vitae expedita velit consectetur aliquid reprehenderit qui ipsum commodi ipsam recusandae distinctio. Minima reprehenderit ipsa nesciunt commodi ab.\\r\\n\\r\\nLorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis, numquam!\\r\\nLorem ipsum dolor sit, amet consectetur adipisicing elit. Consectetur mollitia, pariatur temporibus dolore porro sint aperiam ullam dolores ipsam exercitationem blanditiis error nisi nemo, architecto voluptatem quidem. Recusandae sit voluptatibus cum porro ad eius tempore modi a possimus aperiam mollitia reprehenderit est, earum nulla dolorem tenetur iusto, rerum omnis, error non quos asperiores nostrum obcaecati. Dolorum, quos obcaecati sunt, consequatur quo aperiam consequuntur voluptates vitae, nostrum fuga nihil. Itaque iste vero, aliquam tempora voluptatem quas dolore, quasi ratione autem iure iusto rem vitae expedita velit consectetur aliquid reprehenderit qui ipsum commodi ipsam recusandae distinctio. Minima reprehenderit ipsa nesciunt commodi ab.
Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis, numquam! Lorem ipsum dolor sit, amet consectetur adipisicing elit. Consectetur mollitia, pariatur temporibus dolore porro sint aperiam ullam dolores ipsam exercitationem blanditiis error nisi nemo, architecto voluptatem quidem. Recusandae sit voluptatibus cum porro ad eius tempore modi a possimus aperiam mollitia reprehenderit est, earum nulla dolorem tenetur iusto, rerum omnis, error non quos asperiores nostrum obcaecati. Dolorum, quos obcaecati sunt, consequatur quo aperiam consequuntur voluptates vitae, nostrum fuga nihil. Itaque iste vero, aliquam tempora voluptatem quas dolore, quasi ratione autem iure iusto rem vitae expedita velit consectetur aliquid reprehenderit qui ipsum commodi ipsam recusandae distinctio. Minima reprehenderit ipsa nesciunt commodi ab.\\r\\n\\r\\nLorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis, numquam!\\r\\nLorem ipsum dolor sit, amet consectetur adipisicing elit. Consectetur mollitia, pariatur temporibus dolore porro sint aperiam ullam dolores ipsam exercitationem blanditiis error nisi nemo, architecto voluptatem quidem. Recusandae sit voluptatibus cum porro ad eius tempore modi a possimus aperiam mollitia reprehenderit est, earum nulla dolorem tenetur iusto, rerum omnis, error non quos asperiores nostrum obcaecati. Dolorum, quos obcaecati sunt, consequatur quo aperiam consequuntur voluptates vitae, nostrum fuga nihil. Itaque iste vero, aliquam tempora voluptatem quas dolore, quasi ratione autem iure iusto rem vitae expedita velit consectetur aliquid reprehenderit qui ipsum commodi ipsam recusandae distinctio. Minima reprehenderit ipsa nesciunt commodi abLorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis, numquam!\\r\\nLorem ipsum dolor sit, amet consectetur adipisicing elit. Consectetur mollitia, pariatur temporibus dolore porro sint aperiam ullam dolores ipsam exercitationem blanditiis error nisi nemo, architecto voluptatem quidem. Recusandae sit voluptatibus cum porro ad eius tempore modi a possimus aperiam mollitia reprehenderit est, earum nulla dolorem tenetur iusto, rerum omnis, error non quos asperiores nostrum obcaecati. Dolorum, quos obcaecati sunt, consequatur quo aperiam consequuntur voluptates vitae, nostrum fuga nihil. Itaque iste vero, aliquam tempora voluptatem quas dolore, quasi ratione autem iure iusto rem vitae expedita velit consectetur aliquid reprehenderit qui ipsum commodi ipsam recusandae distinctio. Minima reprehenderit ipsa nesciunt commodi ab.","Hospital Services","Hospital Services","domain.png","team-doctors-standing-row_107420-84772.jpg","2025-02-21 21:25:49");
INSERT INTOblog VALUES("3","Your Health Matters: Expert Tips from Our Hospital","Lorem ipsum odor amet, consectetuer adipiscing elit. Parturient cursus rhoncus velit turpis sociosqu dapibus. Nulla iaculis libero diam iaculis nisi. Pretium taciti pretium, urna commodo libero montes leo litora. Pulvinar nascetur etiam mi commodo justo, montes rhoncus class. Praesent aenean per nascetur tempor dignissim conubia praesent scelerisque.\\r\\n\\r\\nQuisque eros vitae placerat lobortis litora turpis justo? Morbi varius habitant scelerisque orci taciti sem. Nam lorem cursus vivamus rutrum placerat nascetur ridiculus. Congue sem pellentesque turpis odio faucibus nisi class pulvinar risus. Dictum adipiscing congue ex tincidunt; habitasse tempus pretium. Laoreet orci tempus morbi consectetur mi pharetra. Habitasse curae velit taciti donec dolor interdum.\\r\\n\\r\\nEnim ex in efficitur dolor euismod arcu. Ultrices aliquet tristique curae massa eu duis natoque inceptos. Praesent odio fringilla ultricies consectetur adipiscing elementum. Vitae lectus curae vulputate phasellus hendrerit adipiscing. Facilisi diam gravida vulputate bibendum tristique. Bibendum inceptos congue enim metus lacinia inceptos praesent commodo. Phasellus a tincidunt mattis nullam platea laoreet. Inceptos efficitur erat pellentesque sem integer.\\r\\n\\r\\nEuismod senectus arcu ipsum in lacus. Fusce quis conubia pretium tristique ornare; fames efficitur. Dapibus taciti posuere rhoncus nullam dignissim. Turpis habitasse rutrum bibendum vestibulum integer; consectetur condimentum? Alibero litora habitant felis suscipit senectus magnis nam lobortis. Sodales eget vulputate tellus vitae ex. Platea platea quis proin sem vestibulum ex iaculis. Egestas neque diam euismod congue eros lorem porta libero sagittis. Sem sagittis mollis sed vitae nunc in dis ornare. Arcu mollis curae suspendisse maecenas scelerisque vestibulum.\\r\\n\\r\\nFeugiat malesuada per bibendum nullam turpis varius odio efficitur quisque. Condimentum fusce lacus consectetur, consectetur taciti ut himenaeos luctus. Nulla lorem sit finibus habitant enim, felis dictumst elementum donec. Sed torquent iaculis est potenti bibendum. Duis convallis convallis ut convallis sapien vel justo. Mattis proin venenatis metus ornare condimentum adipiscing hendrerit porta. Porttitor eleifend vehicula tellus vehicula habitasse turpis, iaculis euismod. Pulvinar viverra et inceptos rhoncus, fermentum phasellus vehicula aliquet. Pharetra mus nulla inceptos consequat platea eu egestas.\\r\\n\\r\\nAdipiscing fermentum facilisis laoreet dui vestibulum congue venenatis. Vitae venenatis ex a ornare sed semper sapien fringilla. Conubia aliquet blandit netus eleifend nisl cras rhoncus potenti. Tristique habitant elit aliquet mauris blandit cubilia quis. Tincidunt sociosqu tellus et; imperdiet metus ridiculus. Felis aliquet posuere taciti nulla lectus.\\r\\n\\r\\nIaculis pharetra pellentesque in consequat; finibus habitant? Fringilla platea et tempus fringilla mi euismod faucibus penatibus. Dapibus velit pulvinar himenaeos nulla ut sem quisque faucibus penatibus. Adipiscing est rutrum purus montes porta laoreet. Himenaeos ultricies integer pulvinar est eros mi; semper nulla vehicula! Cubilia integer elit turpis proin nibh. Imperdiet a maximus penatibus commodo, aliquet enim. Tincidunt conubia potenti vivamus orci cubilia nibh. Etiam blandit orci pellentesque pellentesque; molestie duis imperdiet elementum.\\r\\n\\r\\nNeque sapien nostra ac rutrum, commodo eu elementum. Nisi semper sociosqu condimentum non ornare? Luctus mi feugiat etiam fermentum non pulvinar leo fames. Enim arcu vivamus risus dui neque elit nibh ligula facilisis. Ullamcorper hendrerit ipsum porttitor vehicula urna orci varius nostra mattis. Condimentum rutrum aenean ipsum in rhoncus ornare. Non diam ridiculus ad eleifend ut massa ultricies vulputate?\\r\\n\\r\\nSem laoreet sociosqu imperdiet curabitur nunc; sed at. Non egestas maximus nibh rhoncus senectus. Pretium venenatis maximus pretium natoque diam magnis ornare integer. Potenti habitant scelerisque mattis consectetur accumsan est luctus. Hac proin ultrices nostra, at est ut varius. Libero quisque aenean non consequat ex. Congue ullamcorper ipsum volutpat sit suspendisse viverra cubilia ipsum. Maximus iaculis scelerisque viverra tristique id metus. Convallis sagittis semper vivamus est duis diam a ad. Conubia turpis orci tristique eget ad class nam id.\\r\\n\\r\\nEget luctus venenatis blandit augue sed. Curabitur blandit vivamus; convallis convallis augue eu enim. Urna iaculis nulla vivamus condimentum mus pellentesque. Fermentum donec vestibulum curae natoque odio; sem faucibus facilisis. Nullam proin sed tempus ut nostra et vehicula. Magnis erat dictum integer lacinia porta magnis cubilia. Taciti condimentum vehicula blandit lacinia ipsum. Cursus cubilia mus proin bibendum nostra facilisis facilisi. Risus praesent elit cursus accumsan nascetur justo viverra.","Your Health Matters","Your Health Matters: Expert Tips from Our Hospital","Tiny doctors and patients near hospital flat vector illustration.jpg","team-doctors-standing-row_107420-84772.jpg","2025-03-01 09:49:51");
INSERT INTOblog VALUES("4","Healthy Living: Advice from Our Medical Experts","Lorem ipsum odor amet, consectetuer adipiscing elit. Parturient cursus rhoncus velit turpis sociosqu dapibus. Nulla iaculis libero diam iaculis nisi. Pretium taciti pretium, urna commodo libero montes leo litora. Pulvinar nascetur etiam mi commodo justo, montes rhoncus class. Praesent aenean per nascetur tempor dignissim conubia praesent scelerisque.\\r\\nQuisque eros vitae placerat lobortis litora turpis justo? Morbi varius habitant scelerisque orci taciti sem. Nam lorem cursus vivamus rutrum placerat nascetur ridiculus. Congue sem pellentesque turpis odio faucibus nisi class pulvinar risus. Dictum adipiscing congue ex tincidunt; habitasse tempus pretium. Laoreet orci tempus morbi consectetur mi pharetra. Habitasse curae velit taciti donec dolor interdum.\\r\\nEnim ex in efficitur dolor euismod arcu. Ultrices aliquet tristique curae massa eu duis natoque inceptos. Praesent odio fringilla ultricies consectetur adipiscing elementum. Vitae lectus curae vulputate phasellus hendrerit adipiscing. Facilisi diam gravida vulputate bibendum tristique. Bibendum inceptos congue enim metus lacinia inceptos praesent commodo. Phasellus a tincidunt mattis nullam platea laoreet. Inceptos efficitur erat pellentesque sem integer.\\r\\nEuismod senectus arcu ipsum in lacus. Fusce quis conubia pretium tristique ornare; fames efficitur. Dapibus taciti posuere rhoncus nullam dignissim. Turpis habitasse rutrum bibendum vestibulum integer; consectetur condimentum? Alibero litora habitant felis suscipit senectus magnis nam lobortis. Sodales eget vulputate tellus vitae ex. Platea platea quis proin sem vestibulum ex iaculis. Egestas neque diam euismod congue eros lorem porta libero sagittis. Sem sagittis mollis sed vitae nunc in dis ornare. Arcu mollis curae suspendisse maecenas scelerisque vestibulum.\\r\\nFeugiat malesuada per bibendum nullam turpis varius odio efficitur quisque. Condimentum fusce lacus consectetur, consectetur taciti ut himenaeos luctus. Nulla lorem sit finibus habitant enim, felis dictumst elementum donec. Sed torquent iaculis est potenti bibendum. Duis convallis convallis ut convallis sapien vel justo. Mattis proin venenatis metus ornare condimentum adipiscing hendrerit porta. Porttitor eleifend vehicula tellus vehicula habitasse turpis, iaculis euismod. Pulvinar viverra et inceptos rhoncus, fermentum phasellus vehicula aliquet. Pharetra mus nulla inceptos consequat platea eu egestas.\\r\\nAdipiscing fermentum facilisis laoreet dui vestibulum congue venenatis. Vitae venenatis ex a ornare sed semper sapien fringilla. Conubia aliquet blandit netus eleifend nisl cras rhoncus potenti. Tristique habitant elit aliquet mauris blandit cubilia quis. Tincidunt sociosqu tellus et; imperdiet metus ridiculus. Felis aliquet posuere taciti nulla lectus.\\r\\nIaculis pharetra pellentesque in consequat; finibus habitant? Fringilla platea et tempus fringilla mi euismod faucibus penatibus. Dapibus velit pulvinar himenaeos nulla ut sem quisque faucibus penatibus. Adipiscing est rutrum purus montes porta laoreet. Himenaeos ultricies integer pulvinar est eros mi; semper nulla vehicula! Cubilia integer elit turpis proin nibh. Imperdiet a maximus penatibus commodo, aliquet enim. Tincidunt conubia potenti vivamus orci cubilia nibh. Etiam blandit orci pellentesque pellentesque; molestie duis imperdiet elementum.\\r\\nNeque sapien nostra ac rutrum, commodo eu elementum. Nisi semper sociosqu condimentum non ornare? Luctus mi feugiat etiam fermentum non pulvinar leo fames. Enim arcu vivamus risus dui neque elit nibh ligula facilisis. Ullamcorper hendrerit ipsum porttitor vehicula urna orci varius nostra mattis. Condimentum rutrum aenean ipsum in rhoncus ornare. Non diam ridiculus ad eleifend ut massa ultricies vulputate?\\r\\nSem laoreet sociosqu imperdiet curabitur nunc; sed at. Non egestas maximus nibh rhoncus senectus. Pretium venenatis maximus pretium natoque diam magnis ornare integer. Potenti habitant scelerisque mattis consectetur accumsan est luctus. Hac proin ultrices nostra, at est ut varius. Libero quisque aenean non consequat ex. Congue ullamcorper ipsum volutpat sit suspendisse viverra cubilia ipsum. Maximus iaculis scelerisque viverra tristique id metus. Convallis sagittis semper vivamus est duis diam a ad. Conubia turpis orci tristique eget ad class nam id.\\r\\nEget luctus venenatis blandit augue sed. Curabitur blandit vivamus; convallis convallis augue eu enim. Urna iaculis nulla vivamus condimentum mus pellentesque. Fermentum donec vestibulum curae natoque odio; sem faucibus facilisis. Nullam proin sed tempus ut nostra et vehicula. Magnis erat dictum integer lacinia porta magnis cubilia. Taciti condimentum vehicula blandit lacinia ipsum. Cursus cubilia mus proin bibendum nostra facilisis facilisi. Risus praesent elit cursus accumsan nascetur justo viverra.","Healthy Living","Healthy Living","istockphoto-1295918822-2048x2048.jpg","1740813418--istockphoto-1295918822-2048x2048.jpg","2025-03-01 10:02:04");


DROP TABLE IF EXISTS blood_donors;

CREATE TABLE `blood_donors` (
  `blood_donor_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `blood_group` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `age` varchar(11) DEFAULT NULL,
  `last_donated` text DEFAULT NULL,
  `is_available` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`blood_donor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTOblood_donors VALUES("9","New Blood Donor","bloodbonor@gmail.com","male","AB+","7889098789","ktm","23","2025-02-12","1","2025-01-12 14:44:04");
INSERT INTOblood_donors VALUES("10","Test","testing@gmail.com","male","A+","9800000090","KTM","18","2025-01-16","1","2025-01-15 14:19:59");


DROP TABLE IF EXISTS contact_page;

CREATE TABLE `contact_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone_num` varchar(255) NOT NULL,
  `tel_number` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTOcontact_page VALUES("1","uniqueneupane153@gmail.com","Dang,Nepal","9809559560","08212344590");


DROP TABLE IF EXISTS diagnosis_report;

CREATE TABLE `diagnosis_report` (
  `diagnosis_report_id` int(11) NOT NULL AUTO_INCREMENT,
  `report_type` text NOT NULL,
  `document_type` enum('pdf','docx','image','excel','other') DEFAULT NULL,
  `file_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `prescription_id` int(11) NOT NULL,
  `laboratorist_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  PRIMARY KEY (`diagnosis_report_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTOdiagnosis_report VALUES("22","x ray","image","Diagnosis_Report_Doc/bannerA.jpg","testing","13","34","39");


DROP TABLE IF EXISTS doctors;

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `specialization` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTOdoctors VALUES("13","40","Pradip","Chand","30","9876098764","Dang","2025-01-22 10:23:57");
INSERT INTOdoctors VALUES("17","52","Prabin","Poudel","30","7898760987","Ktm","2025-01-24 14:36:11");
INSERT INTOdoctors VALUES("21","92","Bhuwan","Bhuwan","31","9860132002","KTM","2025-02-18 11:17:06");


DROP TABLE IF EXISTS invoice;

CREATE TABLE `invoice` (
  `invoice_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_num` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `payment_method` enum('cash','card','online','insurance') NOT NULL DEFAULT 'cash',
  `amount` decimal(10,2) NOT NULL,
  `payment_status` enum('paid','unpaid') NOT NULL DEFAULT 'unpaid',
  `invoice_date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`invoice_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTOinvoice VALUES("31","972639","39","Check Up","cash","234.00","unpaid","2025-02-18 20:26:17");
INSERT INTOinvoice VALUES("32","388270","37","Check Up","cash","2000.00","unpaid","2025-02-22 12:00:58");


DROP TABLE IF EXISTS laboratorists;

CREATE TABLE `laboratorists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `qualification` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTOlaboratorists VALUES("2","34","9878709876","Dang","male","Bachelor Pass");


DROP TABLE IF EXISTS medicine;

CREATE TABLE `medicine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `medicine_name` varchar(255) NOT NULL,
  `category` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `manufacuturin_company` varchar(255) NOT NULL,
  `manufacuturin_date` date NOT NULL DEFAULT current_timestamp(),
  `stock` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTOmedicine VALUES("3","Testing medicine","4","123","sasas","1212","2024-10-17","12");
INSERT INTOmedicine VALUES("7","Paracetamol","6","2332","ParacetamolParacetamol ParacetamolParacetamolParacetamolParacetamol ParacetamolParacetamol","abc","2025-01-15","245");
INSERT INTOmedicine VALUES("8","Antibiotics","13","250","Used to treat bacterial infections","abc","2025-01-31","50");
INSERT INTOmedicine VALUES("9","Paracetamol","10","129","A common painkiller and fever reducer","XYZ","2025-02-19","40");


DROP TABLE IF EXISTS medicine_cat;

CREATE TABLE `medicine_cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `medicine_name` varchar(255) NOT NULL,
  `medicine_description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTOmedicine_cat VALUES("10","Painkillers","Medicines used to relieve pain","2025-01-29 13:30:28");
INSERT INTOmedicine_cat VALUES("11","Antipyretics","Medicines used to reduce fever","2025-01-29 13:31:55");
INSERT INTOmedicine_cat VALUES("12","Vitamins","Supplements that provide essential nutrients","2025-01-29 13:32:14");
INSERT INTOmedicine_cat VALUES("13","Antihistamines","Medicines used to treat allergic reactions","2025-01-29 13:44:35");


DROP TABLE IF EXISTS notice_board;

CREATE TABLE `notice_board` (
  `notice_id` int(11) NOT NULL AUTO_INCREMENT,
  `notice_title` varchar(255) NOT NULL,
  `notice` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`notice_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTOnotice_board VALUES("15","Testing","Notice","2025-02-21 08:02:17");
INSERT INTOnotice_board VALUES("16","New Testsing","testing tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesingtesting tesing","2025-02-21 08:10:39");


DROP TABLE IF EXISTS nurse;

CREATE TABLE `nurse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `qualification` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTOnurse VALUES("2","26","9855757634","Dang","female","12 Pass");
INSERT INTOnurse VALUES("24","75","9864728223","ktm","male","Bachelor Pass");


DROP TABLE IF EXISTS patient;

CREATE TABLE `patient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `sex` enum('male','female','other') NOT NULL,
  `blood_group` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `added_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTOpatient VALUES("37","82","Bhupendra Chand","25","male","A+","Dhangadhi","9890987678","0");
INSERT INTOpatient VALUES("39","90","Patient Unique","23","male","B+","Dhangadhi","2345678906","0");
INSERT INTOpatient VALUES("42","95","Add Prabin Poudel new Check","26","male","B+","KTM","9809559569","52");


DROP TABLE IF EXISTS payment;

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_type` text NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `payment_method` enum('cash','card','online','insurance') NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



DROP TABLE IF EXISTS pharmacist;

CREATE TABLE `pharmacist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `qualification` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTOpharmacist VALUES("4","97","9809559990","KTM","male","Bachelor Pass");


DROP TABLE IF EXISTS prescription;

CREATE TABLE `prescription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `case_history` text NOT NULL,
  `medication` text NOT NULL,
  `medication_form_pharamcist` text NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTOprescription VALUES("13","17","39","Case History","meidcation","naaaaaa","aaaaaaaaaa","2025-02-18");


DROP TABLE IF EXISTS profile;

CREATE TABLE `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTOprofile VALUES("2","27","9809595560","Dang");


DROP TABLE IF EXISTS query_contact;

CREATE TABLE `query_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `message` text NOT NULL,
  `status` enum('unread','read') NOT NULL DEFAULT 'unread',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTOquery_contact VALUES("1","Khem raj Neupane","khemrajneupane111@gmail.com","9809559560","aaaaaaaaaaaaa","read");
INSERT INTOquery_contact VALUES("4","Testing","testing@gmail.com","9809999999","hello Testing this message","read");
INSERT INTOquery_contact VALUES("12","Testing Contact Status","unique@gmail.com","9898090987","aaaaaaaaaaa","unread");
INSERT INTOquery_contact VALUES("13","Contact msg","msg@gmail.com","9898789097","aaaaaa","unread");


DROP TABLE IF EXISTS report;

CREATE TABLE `report` (
  `rep_id` int(11) NOT NULL AUTO_INCREMENT,
  `report_type` enum('operation','birth','death','other') NOT NULL,
  `description` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  PRIMARY KEY (`rep_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTOreport VALUES("27","other","hahahah","2025-01-28 00:00:00","17","23");
INSERT INTOreport VALUES("29","operation","testing","2025-01-28 00:00:00","13","23");
INSERT INTOreport VALUES("30","birth","daeth","2025-01-28 07:17:29","17","23");
INSERT INTOreport VALUES("31","other","Testing","2025-01-28 00:00:00","13","28");


DROP TABLE IF EXISTS setting;

CREATE TABLE `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `website_name` varchar(255) NOT NULL,
  `website_title` varchar(255) NOT NULL,
  `footer` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTOsetting VALUES("1","H<span>Management System</span>","Hospital Management System","Copyright©2025-Feb-19 Unique Neupane. All right reserved");


DROP TABLE IF EXISTS specialization;

CREATE TABLE `specialization` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `specialization` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTOspecialization VALUES("30","Specializes in nervous system issues.","Neurologist","2025-01-16 13:44:58");
INSERT INTOspecialization VALUES("31","Specializes in bone and joint issues.","Orthopedic","2025-01-16 13:45:13");
INSERT INTOspecialization VALUES("32","Specializes in children’s health.","Pediatrician","2025-01-16 13:45:27");
INSERT INTOspecialization VALUES("33","Specializes in skin-related issues.","Dermatologist","2025-01-16 13:45:41");
INSERT INTOspecialization VALUES("34","Specializes in heart-related issues.","Cardiologist","2025-01-16 14:05:55");


DROP TABLE IF EXISTS user_tbl;

CREATE TABLE `user_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `otp_code` varchar(6) DEFAULT NULL,
  `otp_exp` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('admin','nurse','doctor','pharmacist','laboratorist','accountant','patient') NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTOuser_tbl VALUES("26","Hello Codee","hello@gmail.com","","2025-02-01 19:32:12","nurse","$2y$10$kTLUnqEu3xu9PiDzgC.WVu1/68g/uSw6DaLizuAxVIyeLh0KBRlUa","2025-01-19 18:30:07");
INSERT INTOuser_tbl VALUES("27","Unique Neupane","unique@gmail.com","","2025-02-01 19:32:12","admin","$2y$10$kj7b3PvRz.Cws7n8m.yMl.MGKYRfkKHdzgIcDM/jPxIhuvtDqwRdC","2025-01-20 16:14:09");
INSERT INTOuser_tbl VALUES("31","Accountant","accountant123@gmail.com","","2025-02-01 19:32:12","accountant","$2y$10$rrd9zKYqVHF3PNmEgNuuOurCepWsWKFfbx78yyfPYoHotfD63zF2W","2025-01-20 17:31:48");
INSERT INTOuser_tbl VALUES("34","Laboratorist","laboratorist@gmail.com","","2025-02-01 19:32:12","laboratorist","$2y$10$4lhLkSuckovmqYeh5S46B.rLBKsHI9K9X1fxGEuvHZBORAcrdObpK","2025-01-20 18:26:45");
INSERT INTOuser_tbl VALUES("40","Pradip Chand","pradipchand@gmail.com","","2025-02-01 19:32:12","doctor","$2y$10$px9GGuGOyNIIIkt7eM3/CuwrNXbk0Y7T6vPks3lLEimcnb60Z9ZQ.","2025-01-22 10:23:57");
INSERT INTOuser_tbl VALUES("52","Prabin Poudel","prabinpoudel@gmail.com","","2025-02-01 19:32:12","doctor","$2y$10$o8gbgQH7uKgSCtCVt0x2gOnO4XLUZ80MxdCI1ugDPpJ2b1PlBUhC6","2025-01-24 14:36:11");
INSERT INTOuser_tbl VALUES("82","Bhupendrachand","bhupendrachand749@gmail.com","498929","2025-02-22 07:18:52","patient","$2y$10$Me5FpFNa4HwywE9Orb06Bu0JFZIp9abqazcwGs3VzHfXYDniAD/Fa","2025-01-31 09:04:24");
INSERT INTOuser_tbl VALUES("90","new unique patient","neupaneunique111@gmail.com","543838","2025-02-27 14:55:20","patient","$2y$10$pGfsu6q7hf4KD/x5eMwve.dzFvU1/xHjMt7R0fqH18TENR5xMh8DK","2025-02-03 10:36:09");
INSERT INTOuser_tbl VALUES("92","Bhuwan","bhuvanjaishi83@gmail.com","","2025-02-18 11:17:05","doctor","$2y$10$.sONapyBL1ldj6TrWSh14.45tMuiZIXBcCTATBWMS5rDIY19hExxq","2025-02-18 11:17:05");
INSERT INTOuser_tbl VALUES("94","Add Prabin Poudel new","newaddprabin@gmail.com","","2025-02-18 18:10:10","patient","$2y$10$NhjZ4oIPskCo2meJFxBQCOBusX25cLX8urHTQfgMjoEhpJodYMw/y","2025-02-18 18:10:10");
INSERT INTOuser_tbl VALUES("95","Add Prabin Poudel new Check","prab@gmail.com","","2025-02-18 18:11:36","patient","$2y$10$5TexsgtZu.Xbs8kNrS3cceHwJa29J7g4aS/0QfKVeMFyKoT6zadIK","2025-02-18 18:11:36");
INSERT INTOuser_tbl VALUES("96","admin Add","xe@gmnail.com","","2025-02-18 18:29:02","patient","$2y$10$ZJwZmsEdKhb5HlKkJD3SGuIgBAr0lTrRrTOQQvGB/fC1al723KazK","2025-02-18 18:29:02");
INSERT INTOuser_tbl VALUES("97","Prarmacist","paramacist@gmail.com","","2025-02-18 19:23:06","pharmacist","$2y$10$M4LllP.CJK8F3mT0EI1AZOOQqGtVcoB5HwMRqZLvCYI93SWhBfpPy","2025-02-18 19:23:06");


