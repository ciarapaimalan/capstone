-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 05, 2020 at 06:57 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `TRAST`
--

-- --------------------------------------------------------

--
-- Table structure for table `AllTicket`
--

CREATE TABLE `AllTicket` (
  `q_id` int(11) NOT NULL DEFAULT 0,
  `question` varchar(255) DEFAULT NULL,
  `answer` varchar(255) DEFAULT NULL,
  `severity` int(11) DEFAULT NULL,
  `role` varchar(45) DEFAULT NULL,
  `id` int(11) NOT NULL DEFAULT 0,
  `message` varchar(225) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'processing'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `AllTicket`
--

INSERT INTO `AllTicket` (`q_id`, `question`, `answer`, `severity`, `role`, `id`, `message`, `username`, `date`, `status`) VALUES
(1, 'What if I can’t log-in?', 'Contact admin for you to be registered and given access to TRAST.', 3, 'Physician', 7, ' trialll', NULL, '2020-02-10 15:58:00', 'Resolved'),
(2, 'Can I change my password?', 'Yes, in the results page after the assessment you can download or print the assessment results by clicking the print button.', 2, 'Physician', 8, ' hello', NULL, '2020-02-11 10:49:18', 'Resolved'),
(1, 'What if I can’t log-in?', 'Contact admin for you to be registered and given access to TRAST.', 3, 'Physician', 9, ' i cant anymore', NULL, '2020-02-12 01:10:35', 'Resolved'),
(6, NULL, NULL, NULL, NULL, 0, ' x', NULL, '2020-02-12 13:23:01', 'processing'),
(2, NULL, NULL, NULL, NULL, 0, ' a', NULL, '2020-02-13 13:35:02', 'processing');

-- --------------------------------------------------------

--
-- Table structure for table `FAQs`
--

CREATE TABLE `FAQs` (
  `q_id` int(11) NOT NULL,
  `question` varchar(500) NOT NULL,
  `answer` varchar(500) NOT NULL,
  `severity` int(11) NOT NULL,
  `role` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `FAQs`
--

INSERT INTO `FAQs` (`q_id`, `question`, `answer`, `severity`, `role`) VALUES
(17, 'What if I can’t find my patient?', 'Probably your patient hasn’t been assessed by the Center for Respiratory Medicine, you can import existing patient in the new patient page or fill in the form.\r\nIn the new patient page, Click Import  > Select the CSV file of the patients to be imported  >  Click Open to import.   ', 5, 'Physician'),
(19, 'What if I can’t login?', 'Contact admin for you to be registered and given access to TRAST.', 5, 'Physician'),
(20, 'Can I print the results?	', 'Yes, in the results page after the assessment you can download or print the assessment results by clicking the print button.\r\nIn the results page, Click Print  >  Select folder where to save the file   >  Click Save.\r\n', 3, 'Physician'),
(21, 'Can I change my password?   ', 'Unfortunately, You cannot change your password. The administrator manages passwords; if you wish to change your password submit a ticket for processing.\r\n\r\nIn the help page, Click Account  >  Create Ticket   >  Enter necessary details  >  Submit.', 2, 'Physician'),
(22, 'What if there’s something wrong with my patient’s records?', 'Irregularities in the patient’s records are probably caused by some typos in entering patient credentials. You can submit a ticket of there are changes in patient records.\r\n\r\nIn the help page, Click Patients  >  Create Ticket   >  Enter necessary details  >  Submit.\r\n\r\nYou can monitor the status of your request in the Profile page.\r\n', 4, 'Physician'),
(23, 'What if I can’t start assessment?', 'This might be caused by slow internet connection or the server is at full load at the moment, you may submit a ticket if this persist.\r\n\r\nIn the help page, Click TRAMSP  >  Create Ticket  >  Enter necessary details  >  Submit.', 5, 'Physician'),
(24, 'What if I can’t import existing patient records?', 'You may be using the unsupported file format for uploading patient records. Make sure that the file you are trying to upload in a CSV file.', 5, 'Physician'),
(25, 'What if I can’t submit my ticket?', 'This might be a server issue. Try a few moments later, if it persists proceed to the IT department for assistance.', 3, 'Physician'),
(26, 'What if I can’t’ view results of the Risk Assessment?', 'There might be a problem in the server, or the internet connection cannot handle such operation. You may retry the assessment and if this persist submit a ticket for your concern.\r\nIn the help page, Click TRAMSP  >  Create Ticket   >  Enter necessary details  >  Submit.\r\n', 5, 'Physician'),
(27, 'What if I can’t register a new physician?', 'This might be a database issue, you may try a few moments later or proceed to the IT department for immediate assistance.', 3, 'Admin'),
(28, 'What if I can’t change the role of the physician?', 'This might be a database issue, you may try a few moments later or proceed to the IT department for immediate assistance.', 2, 'Admin'),
(29, 'What if I can’t view the patient list?  ', 'This might be a database issue, you may try a few moments later or proceed to the IT department for immediate assistance.', 2, 'Admin'),
(30, 'What if I can’t change an incident ticket to resolved or processing?', 'This might be a database issue, you may try a few moments later or proceed to the IT department for immediate assistance.', 5, 'Admin'),
(31, 'What if I can’t modify the content of the website?', 'This might be a database issue, you may try a few moments later or proceed to the IT department for immediate assistance.', 4, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `Patient`
--

CREATE TABLE `Patient` (
  `ph_id` int(11) NOT NULL,
  `patient_lname` varchar(45) NOT NULL,
  `patient_mname` varchar(45) NOT NULL,
  `patient_fname` varchar(45) NOT NULL,
  `birthdate` date NOT NULL,
  `sex` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  `contactno` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Patient`
--

INSERT INTO `Patient` (`ph_id`, `patient_lname`, `patient_mname`, `patient_fname`, `birthdate`, `sex`, `address`, `contactno`) VALUES
(1, 'Paimalan', 'E.', 'Ciara', '1999-04-23', 'Female', 'Las Piñas City', ''),
(3, 'Espinili', 'R.', 'Neil', '1998-11-03', 'Male', 'Manila', ''),
(4, 'Dadulla', 'M.', 'Denice', '1997-01-01', 'Female', 'Manila', ''),
(9, 'Paimalan', 'Espinosa', 'Ciara', '1999-04-23', 'Female', 'Las Piñas City', ''),
(10, 'Paimalan', 'Espinosa', 'Earl', '2003-05-03', 'Male', 'Las Pinas City', ''),
(11, 'Paimalan', 'Espinosa', 'Earl', '2003-05-03', 'Male', 'Las Pinas City', ''),
(12, 'Paimalan', 'Espinosa', 'Earl', '2003-05-03', 'Male', 'Las Pinas City', ''),
(13, 'Paimalan', 'Espinosa', 'Flor', '2003-05-03', 'Male', 'Las Pinas City', ''),
(14, 'Paimalan', 'Espinosa', 'Flor', '2003-05-03', 'Male', 'Las Pinas City', ''),
(15, 'Paimalan', 'Espinosa', 'Christymae', '2003-05-03', 'Male', 'Las Pinas City', ''),
(16, 'Paimalan', 'Espinosa', 'Marilyn', '2003-05-03', 'Male', 'Las Pinas City', ''),
(17, 'Paimalan', 'Espinosa', 'Earl', '2003-05-03', 'male', 'Las Piñas City', '09262178543'),
(18, 'Paimala', 'Espinosa', 'Flor', '1998-10-05', 'female', 'Las Piñas City', '09262178543');

-- --------------------------------------------------------

--
-- Table structure for table `PatientHistory`
--

CREATE TABLE `PatientHistory` (
  `ph_id` int(11) NOT NULL,
  `patient_fname` varchar(255) DEFAULT NULL,
  `patient_mname` varchar(255) DEFAULT NULL,
  `patient_lname` varchar(255) DEFAULT NULL,
  `age` int(45) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `pulmonary_diagnosis` varchar(255) DEFAULT NULL,
  `other_diagnosis` varchar(255) DEFAULT NULL,
  `oxygen_lvl` varchar(255) DEFAULT NULL,
  `special_endorsement` varchar(255) DEFAULT NULL,
  `physician` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `ward` varchar(255) DEFAULT NULL,
  `bed_no` varchar(255) DEFAULT NULL,
  `admission_no` varchar(255) DEFAULT NULL,
  `hosp_no` varchar(255) DEFAULT NULL,
  `admission_date` varchar(255) DEFAULT NULL,
  `disposition` varchar(255) DEFAULT NULL,
  `discharge_date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `PatientHistory`
--

INSERT INTO `PatientHistory` (`ph_id`, `patient_fname`, `patient_mname`, `patient_lname`, `age`, `birthdate`, `sex`, `address`, `pulmonary_diagnosis`, `other_diagnosis`, `oxygen_lvl`, `special_endorsement`, `physician`, `status`, `ward`, `bed_no`, `admission_no`, `hosp_no`, `admission_date`, `disposition`, `discharge_date`) VALUES
(1, 'Elvio', 'Espinosa', 'Vargas', 45, '1975-01-05', 'Male', 'Manila ', 'Moderate Risk', 'Infected Bronchiestasis', 'Normal', 'MEROP', 'Elvin Garcia,M.D', 'Guarded, To Metropolitan', 'CVU 2247', '2003', '11601', '10K001', '2011-01-10', 'Discharge', '12/09/10'),
(2, 'Niguel Ian', 'Tagalaugon', 'Pamintuan', 30, '1990-04-21', 'Male', 'Quezon ', 'Low Risk ', 'CAP Progress', 'Normal', 'CIPRO,CO-AMOX,FLUC', 'Earl Sempio,M.D', 'MGB', 'G*San Rafael 2467', '3068 D', '11605', '10J01343', '2011-02-10', 'Discharge', '11/16/2010'),
(3, 'Ciara', 'Espinosa', 'Paimalan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Ciara', 'Espinosa', 'Paimalan', 20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `PatientInfo`
--

CREATE TABLE `PatientInfo` (
  `info_id` int(11) NOT NULL,
  `ph_id` int(11) NOT NULL,
  `patient_fname` varchar(255) DEFAULT NULL,
  `patient_mname` varchar(255) DEFAULT NULL,
  `patient_lname` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `birthdate` varchar(255) DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `pulmonary_diagnosis` varchar(255) DEFAULT NULL,
  `other_diagnosis` varchar(255) DEFAULT NULL,
  `oxygen_lvl` varchar(255) DEFAULT NULL,
  `special_endorsement` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `ward` varchar(255) DEFAULT NULL,
  `bed_no` varchar(255) DEFAULT NULL,
  `admission_no` varchar(255) DEFAULT NULL,
  `hosp_no` varchar(255) DEFAULT NULL,
  `admission_date` varchar(255) DEFAULT NULL,
  `disposition` varchar(255) DEFAULT NULL,
  `discharge_date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `PatientInfo`
--

INSERT INTO `PatientInfo` (`info_id`, `ph_id`, `patient_fname`, `patient_mname`, `patient_lname`, `age`, `birthdate`, `sex`, `address`, `pulmonary_diagnosis`, `other_diagnosis`, `oxygen_lvl`, `special_endorsement`, `username`, `status`, `ward`, `bed_no`, `admission_no`, `hosp_no`, `admission_date`, `disposition`, `discharge_date`) VALUES
(1, 1, 'Elvio', 'Kato', 'Vargas', 45, '05-01-75', 'Male', 'Manila ', 'Moderate Risk', 'Infected Bronchiestasis', 'Normal', 'MEROP', 'Elvin Garcia,M.D', 'Guarded, To Metropolitan', 'CVU 2247', '2003', '11601', '10K001', '01-11-10', 'Discharge', '09-12-10');

-- --------------------------------------------------------

--
-- Table structure for table `PH`
--

CREATE TABLE `PH` (
  `ph_id` int(11) NOT NULL,
  `patient_fname` varchar(255) NOT NULL,
  `patient_mname` varchar(255) NOT NULL,
  `patient_lname` varchar(255) NOT NULL,
  `age` int(45) NOT NULL,
  `birthdate` datetime NOT NULL,
  `sex` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `pulmonary_diagnosis` varchar(255) NOT NULL,
  `other_diagnosis` varchar(255) NOT NULL,
  `oxygen_lvl` varchar(255) NOT NULL,
  `special_endorsement` varchar(255) NOT NULL,
  `physician` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `ward` varchar(255) NOT NULL,
  `bed_no` varchar(255) NOT NULL,
  `admission_no` varchar(255) NOT NULL,
  `hosp_no` varchar(255) NOT NULL,
  `admission_date` datetime NOT NULL,
  `disposition` varchar(255) NOT NULL,
  `discharge_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `PH`
--

INSERT INTO `PH` (`ph_id`, `patient_fname`, `patient_mname`, `patient_lname`, `age`, `birthdate`, `sex`, `address`, `pulmonary_diagnosis`, `other_diagnosis`, `oxygen_lvl`, `special_endorsement`, `physician`, `status`, `ward`, `bed_no`, `admission_no`, `hosp_no`, `admission_date`, `disposition`, `discharge_date`) VALUES
(1, 'Elvio', 'Espinosa', 'Vargas', 45, '1975-01-05 00:00:00', 'Male', 'Manila ', 'Moderate Risk', 'Infected Bronchiestasis', 'Normal', 'MEROP', 'Elvin Garcia,M.D', 'Guarded, To Metropolitan', 'CVU 2247', '2003', '11601', '10K001', '2011-01-10 00:00:00', 'Discharge', '2012-09-10 00:00:00'),
(2, 'Niguel Ian', 'Tagalaugon', 'Pamintuan', 30, '1990-04-21 00:00:00', 'Male', 'Quezon ', 'Low Risk ', 'CAP Progress', 'Normal', 'CIPRO,CO-AMOX,FLUC', 'Earl Sempio,M.D', 'MGB', 'G*San Rafael 2467', '3068 D', '11605', '10J01343', '2011-02-10 00:00:00', 'Discharge', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `Physician`
--

CREATE TABLE `Physician` (
  `phy_ID` int(11) NOT NULL,
  `phys_lname` varchar(45) NOT NULL,
  `phys_mname` varchar(45) NOT NULL,
  `phys_fname` varchar(45) NOT NULL,
  `phys_username` varchar(45) NOT NULL,
  `yr_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `RiskAssessment`
--

CREATE TABLE `RiskAssessment` (
  `RA_ID` int(11) NOT NULL,
  `ph_id` int(11) DEFAULT NULL,
  `step_one` varchar(255) DEFAULT NULL,
  `step_two` varchar(255) DEFAULT NULL,
  `regimen` varchar(255) NOT NULL,
  `trf` int(45) DEFAULT NULL,
  `anticoagulants` varchar(255) DEFAULT NULL,
  `anticoagulants_elab` varchar(255) DEFAULT 'None',
  `modalities` varchar(255) DEFAULT NULL,
  `other_modalities` varchar(255) DEFAULT 'None',
  `username` varchar(255) DEFAULT NULL,
  `exam_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `RiskAssessment`
--

INSERT INTO `RiskAssessment` (`RA_ID`, `ph_id`, `step_one`, `step_two`, `regimen`, `trf`, `anticoagulants`, `anticoagulants_elab`, `modalities`, `other_modalities`, `username`, `exam_date`) VALUES
(120, 1, 'Minor surgery', 'Inflammatory bowel disease, Obesity (>20% of ideal body weight)', 'GCS* and IPC or LDUH (q8h) or LMWH', 3, 'No', '', 'Graduated compression stockings (GCS), Intermittent pneumatic compression (IPC)', '', 'ciarapaimalan', '2020-02-24 18:47:18'),
(121, 1, 'Immobilizing plaster cast', 'Oral contraceptives or hormone replacement therapy', 'No Specific Measures Early Ambulation', 1, 'No', '', 'Intermittent pneumatic compression (IPC)', '', 'ciarapaimalan', '2020-02-24 19:01:48'),
(122, 1, 'Minor surgery', 'Age 41 to 60 years', 'IPC or LDUH (q12h) or LMWH or GCS', 2, 'No', '', 'Intermittent pneumatic compression (IPC)', '', 'ciarapaimalan', '2020-02-28 02:30:41'),
(123, 9, 'Acute spinal cord injury (paralysis)', 'Age 41 to 60 years', 'LDUH (q8h) or LMWH	GCS* and IPC + (LDUH or LMWH) or ADH or LMWH Oral Anticoagulants', 6, 'No', '', 'Graduated compression stockings (GCS)', '', 'ciarapaimalan', '2020-03-04 00:06:31');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `q_id` int(11) DEFAULT NULL,
  `question` varchar(255) NOT NULL,
  `message` varchar(225) DEFAULT NULL,
  `severity` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `date` datetime NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'processing'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id`, `q_id`, `question`, `message`, `severity`, `username`, `date`, `status`) VALUES
(23, 3, 'What if I can’t find my patient?', ' eee', 3, 'ciarapaimalan', '2020-02-13 16:24:50', 'Cancelled'),
(24, 12, 'What if I can’t change the role of the physician?', ' ss', 1, NULL, '2020-02-13 16:50:23', 'Resolved'),
(25, 10, 'What if I can’t submit my ticket?', 'SANA GUMANA KA', 2, NULL, '2020-02-13 16:51:06', 'Resolved'),
(26, 2, 'Can I change my password?', ' nn', 2, NULL, '2020-02-16 15:10:29', 'processing'),
(27, 12, 'What if I can’t change the role of the physician?', 'shdjshd ', 1, NULL, '2020-02-17 12:18:46', 'Processing'),
(28, 1, 'What if I can’t log-in?', 'asasa', 3, NULL, '2020-03-01 21:09:18', 'processing'),
(29, 2, 'Can I change my password?', ' dsd', 2, NULL, '2020-03-01 21:21:29', 'processing'),
(30, 3, 'What if I can’t find my patient?', ' sdsd', 3, NULL, '2020-03-01 21:27:40', 'processing'),
(31, 2, 'Can I change my password?', ' ', 2, NULL, '2020-03-01 21:45:33', 'processing'),
(32, 4, 'What if there’s something wrong with my patient’s records?', ' cxc', 2, NULL, '2020-03-01 21:47:08', 'processing'),
(33, 4, 'What if there’s something wrong with my patient’s records?', 'dsd ', 2, NULL, '2020-03-01 21:48:15', 'processing'),
(34, 4, 'What if there’s something wrong with my patient’s records?', 'dsd ', 2, NULL, '2020-03-01 21:48:15', 'processing'),
(35, 3, 'What if I can’t find my patient?', ' dsd', 3, NULL, '2020-03-01 21:49:50', 'processing'),
(36, 2, 'Can I change my password?', 'HELLOHI', 2, NULL, '2020-03-01 21:55:10', 'processing'),
(37, 4, 'What if there’s something wrong with my patient’s records?', ' TRYULIT', 2, NULL, '2020-03-01 21:55:46', 'processing'),
(38, 4, 'What if there’s something wrong with my patient’s records?', ' TRYULIT', 2, NULL, '2020-03-01 21:56:18', 'processing'),
(39, 4, 'What if there’s something wrong with my patient’s records?', ' sdds', 2, NULL, '2020-03-01 22:09:38', 'processing'),
(40, 2, 'Can I change my password?', ' kjkjkj', 2, NULL, '2020-03-02 18:24:26', 'processing'),
(41, 6, 'What if I can’t import existing patient records?', ' WEWEWEE', 1, 'ciarapaimalan', '2020-03-02 18:30:51', 'processing'),
(42, 1, 'What if I can’t log-in?', 'hiiii', 3, 'neilespinili', '2020-03-02 18:31:48', 'processing'),
(43, 3, 'What if I can’t find my patient?', ' TRIAL HELP', 3, 'ciarapaimalan', '2020-03-03 12:18:26', 'processing'),
(44, 19, 'What if I can’t login?', ' HELLO TRIAL', 5, 'ciarapaimalan', '2020-03-03 14:47:22', 'processing');

-- --------------------------------------------------------

--
-- Table structure for table `UserAccnt`
--

CREATE TABLE `UserAccnt` (
  `username` varchar(255) NOT NULL,
  `Fullname` varchar(255) NOT NULL,
  `password` varchar(45) NOT NULL,
  `role` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `UserAccnt`
--

INSERT INTO `UserAccnt` (`username`, `Fullname`, `password`, `role`) VALUES
('ciarapaimalan', 'Ciara Paimalan', '123', 'Physician'),
('neilespinili', 'Neil Espinili', 'abc', 'Physician');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `FAQs`
--
ALTER TABLE `FAQs`
  ADD PRIMARY KEY (`q_id`);

--
-- Indexes for table `Patient`
--
ALTER TABLE `Patient`
  ADD PRIMARY KEY (`ph_id`);

--
-- Indexes for table `PatientHistory`
--
ALTER TABLE `PatientHistory`
  ADD PRIMARY KEY (`ph_id`);

--
-- Indexes for table `PatientInfo`
--
ALTER TABLE `PatientInfo`
  ADD PRIMARY KEY (`info_id`),
  ADD UNIQUE KEY `ph_id` (`ph_id`);

--
-- Indexes for table `Physician`
--
ALTER TABLE `Physician`
  ADD PRIMARY KEY (`phy_ID`);

--
-- Indexes for table `RiskAssessment`
--
ALTER TABLE `RiskAssessment`
  ADD PRIMARY KEY (`RA_ID`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `UserAccnt`
--
ALTER TABLE `UserAccnt`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `FAQs`
--
ALTER TABLE `FAQs`
  MODIFY `q_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `Patient`
--
ALTER TABLE `Patient`
  MODIFY `ph_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `PatientHistory`
--
ALTER TABLE `PatientHistory`
  MODIFY `ph_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `PatientInfo`
--
ALTER TABLE `PatientInfo`
  MODIFY `info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Physician`
--
ALTER TABLE `Physician`
  MODIFY `phy_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `RiskAssessment`
--
ALTER TABLE `RiskAssessment`
  MODIFY `RA_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
