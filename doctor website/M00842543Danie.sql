-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 22, 2022 at 02:57 AM
-- Server version: 8.0.31-0ubuntu0.20.04.2
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `M00842543Danie`
--
CREATE DATABASE IF NOT EXISTS `M00842543Danie` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `M00842543Danie`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `userID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `FirstName`, `LastName`, `userID`) VALUES
(1, 'QkhUOXp4V1IzZmdTM3VIZHNvVTZ5dz09Ojop6wJDiihnUSR/ZF1os0Xy', 'dFZRTEYyTWJXaUVNaG50WHBPeDRLdz09OjoyxXpQITiJ8tYMjf4chsQq', 1);

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointmentID` int NOT NULL,
  `doctorID` int NOT NULL,
  `doctorfn` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `doctorln` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `patientID` int NOT NULL,
  `patientfn` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `patientln` varchar(100) NOT NULL,
  `doctorscheduleID` int NOT NULL,
  `doctor_schedule_date` date NOT NULL,
  `doctor_schedule_starttime` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `medicalnotes` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointmentID`, `doctorID`, `doctorfn`, `doctorln`, `patientID`, `patientfn`, `patientln`, `doctorscheduleID`, `doctor_schedule_date`, `doctor_schedule_starttime`, `medicalnotes`) VALUES
(7, 1, 'SUUyWXRSUUI5RitlNmRpRkFGdm9TZz09OjpwjLupYiRQkyHGQmkt/dSd', 'SWRpUEE0amZ2TjFFam9rOXJsczl1Zz09OjqCag0YBlr3Ikvb7QU1K/3x', 3, 'bHRwcHh6bjNQZnQwSWhMb3FFOTRFQT09OjoiX2JD+uehvoPo1YCAzDzZ', 'K3BUSk1rNTFyYXhBTFN3OVVzTDFQQT09OjqCYoritY6rFHF6NA9jlMHo', 4, '2022-11-24', '10:00', 'd2VBYnZ6eEN6QXdWQlhvVEcyNXhxR3B1M3lqYWllZGtOQkdRMzd0VlpRMXJsakNWdmNNbmFUTmtOR2dEeE1kM0FQYlBES0YydXJtWGIyK2Z2eThpVHJCRW9PS2U2VVlWcDZhUVFncWRlVkdMTXNIVk4rQjNzTE1GTkEvUXYvUFhGRXp0aE5pRGVPMUV0MDZvMEpFdUFRPT06OiMBlF1SVMeOdI/jKndDhBM='),
(8, 1, 'SUUyWXRSUUI5RitlNmRpRkFGdm9TZz09OjpwjLupYiRQkyHGQmkt/dSd', 'SWRpUEE0amZ2TjFFam9rOXJsczl1Zz09OjqCag0YBlr3Ikvb7QU1K/3x', 3, 'bHRwcHh6bjNQZnQwSWhMb3FFOTRFQT09OjoiX2JD+uehvoPo1YCAzDzZ', 'K3BUSk1rNTFyYXhBTFN3OVVzTDFQQT09OjqCYoritY6rFHF6NA9jlMHo', 5, '2022-11-24', '11:00', 'c1BwcVd2c0JVUnhFdGx2Y3dHMmQ3QT09OjqF8JMUaUutPPNLrTb1WfOw'),
(9, 1, 'TUIyaVFjeno2R3B4VFc0K1doS3ZoZz09Ojrxri7ZjS+3AhTlAnv/dvPI', 'OTFBZE5NYkliL25EUTZYUW1qY1BCdz09Ojq87MnqLr4IIdypzOy2CGqh', 3, 'NVFiZ1lyNTlUTE12eHpNbDNvbWI1UT09OjonNQf6JvtUOGumwrIm9y0L', 'cmNlWXYvbjFHVFhiYXgwV21ZM2xUdz09Ojqb8IGplRM8D3Sx26A2pzdf', 6, '2022-11-24', '12:00', 'L3hSRDJGeFR4eWtZZGQ4cXFnR1ZBaHNyK2ZZZExad0dqQVVKTXhtMDhXKytZUks3dmVtWHh0QUcxcnVRVnhwbmFubkFDRWpibUpOL0Y1ZUZQNU1JdzJYZCt6WklBOXROWVNpSklMa0lNOVE9Ojov6NmSRI+vdlHNzQzeKmrE'),
(10, 1, 'TUIyaVFjeno2R3B4VFc0K1doS3ZoZz09Ojrxri7ZjS+3AhTlAnv/dvPI', 'OTFBZE5NYkliL25EUTZYUW1qY1BCdz09Ojq87MnqLr4IIdypzOy2CGqh', 2, 'L2tSQUZGVklEWnRkeDZWMmJ2UmpHQT09OjpV6WUvexI2naB1mkoSBRQF', 'a2F2WHFlSXhsbVZCcTE1RkFwNmp0Zz09OjpEQQhU6F+6isXSGE2yTHsO', 7, '2022-11-24', '13:00', 'Y2IrZVRXMElXRmtqUkhZc2Z1RWs1Y090RzFBOUpIQ0hIWGwyakVpVkZSbW5VTzlsME40NkM3SE1iRit6K2k4TGZ0QlExYkVTU0ZkUzNPOWNJbVpOVDVML1B1N1FxT1RVaExyVUJFMzZIM2w3cVozQ1lsb29QVEZzV3hJeTZyMEo4SWc2dnE5YmgrT1dRU0pUcTNqMEF3PT06OnteyIV7lPRP/LRIoCd6ynU='),
(11, 2, 'NDI1YTc5Q2dFZ04xT292VkoyZWhMUT09OjqrY6s6WlRydd+R5A2aehwj', 'Vm1VdHJib0RHSXZjS24vOXRNZFFNZz09Ojr+NxKSzhQYaD0WPuOz8UUv', 2, 'L2tSQUZGVklEWnRkeDZWMmJ2UmpHQT09OjpV6WUvexI2naB1mkoSBRQF', 'a2F2WHFlSXhsbVZCcTE1RkFwNmp0Zz09OjpEQQhU6F+6isXSGE2yTHsO', 18, '2022-11-24', '14:00', 'TFZwYXhEWmpiTHFqTTdUd28wYmRITHJIR25XaTg5MEVMTUNPK29HdGYvdlFKWjkzcU5KYVE4aWZRTTM4M2oxUHZ2WEl5K2dMZmY3WUxkbklyUEZITWc9PTo63q+dr7bOY8W8xFWn5wJlqg=='),
(12, 1, 'TUIyaVFjeno2R3B4VFc0K1doS3ZoZz09Ojrxri7ZjS+3AhTlAnv/dvPI', 'OTFBZE5NYkliL25EUTZYUW1qY1BCdz09Ojq87MnqLr4IIdypzOy2CGqh', 3, 'YkloaVVaT2xmY3Q5dUIwWUNCbFBjQT09OjqB3N3V3GsqyGvexecsikK4', 'b01uZG5tSW96NHlGMDFseXdEZEN2dz09OjpAV6jJtSqcm3YuovNROiVa', 8, '2022-11-24', '14:00', 'YzZzcklRNmhINzBXZ1dGaHljMjR4eitnMTdGUnYvZmZDdFlvTGdrZHNSYz06Oq2GJwFYgVrRojvnZgp68fQ=');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doctorID` int NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `userID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctorID`, `FirstName`, `LastName`, `userID`) VALUES
(1, 'TUIyaVFjeno2R3B4VFc0K1doS3ZoZz09Ojrxri7ZjS+3AhTlAnv/dvPI', 'OTFBZE5NYkliL25EUTZYUW1qY1BCdz09Ojq87MnqLr4IIdypzOy2CGqh', 2),
(2, 'NDI1YTc5Q2dFZ04xT292VkoyZWhMUT09OjqrY6s6WlRydd+R5A2aehwj', 'Vm1VdHJib0RHSXZjS24vOXRNZFFNZz09Ojr+NxKSzhQYaD0WPuOz8UUv', 3);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_schedule_table`
--

CREATE TABLE `doctor_schedule_table` (
  `doctorscheduleID` int NOT NULL,
  `doctorID` int NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `doctor_schedule_date` date NOT NULL,
  `doctor_schedule_day` enum('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday') NOT NULL,
  `doctor_schedule_starttime` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `doctor_schedule_endtime` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `doctor_schedule_status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `doctor_schedule_table`
--

INSERT INTO `doctor_schedule_table` (`doctorscheduleID`, `doctorID`, `FirstName`, `LastName`, `doctor_schedule_date`, `doctor_schedule_day`, `doctor_schedule_starttime`, `doctor_schedule_endtime`, `doctor_schedule_status`) VALUES
(1, 1, 'SUUyWXRSUUI5RitlNmRpRkFGdm9TZz09OjpwjLupYiRQkyHGQmkt/dSd', 'SWRpUEE0amZ2TjFFam9rOXJsczl1Zz09OjqCag0YBlr3Ikvb7QU1K/3x', '2022-11-24', 'Thursday', '6:00', '7:00', 'Active'),
(2, 1, 'SUUyWXRSUUI5RitlNmRpRkFGdm9TZz09OjpwjLupYiRQkyHGQmkt/dSd', 'SWRpUEE0amZ2TjFFam9rOXJsczl1Zz09OjqCag0YBlr3Ikvb7QU1K/3x', '2022-11-24', 'Thursday', '7:00', '8:00', 'Active'),
(3, 1, 'SUUyWXRSUUI5RitlNmRpRkFGdm9TZz09OjpwjLupYiRQkyHGQmkt/dSd', 'SWRpUEE0amZ2TjFFam9rOXJsczl1Zz09OjqCag0YBlr3Ikvb7QU1K/3x', '2022-11-24', 'Thursday', '8:00', '9:00', 'Active'),
(4, 1, 'SUUyWXRSUUI5RitlNmRpRkFGdm9TZz09OjpwjLupYiRQkyHGQmkt/dSd', 'SWRpUEE0amZ2TjFFam9rOXJsczl1Zz09OjqCag0YBlr3Ikvb7QU1K/3x', '2022-11-24', 'Thursday', '10:00', '11:00', 'Inactive'),
(5, 1, 'SUUyWXRSUUI5RitlNmRpRkFGdm9TZz09OjpwjLupYiRQkyHGQmkt/dSd', 'SWRpUEE0amZ2TjFFam9rOXJsczl1Zz09OjqCag0YBlr3Ikvb7QU1K/3x', '2022-11-24', 'Thursday', '11:00', '12:00', 'Inactive'),
(6, 1, 'SUUyWXRSUUI5RitlNmRpRkFGdm9TZz09OjpwjLupYiRQkyHGQmkt/dSd', 'SWRpUEE0amZ2TjFFam9rOXJsczl1Zz09OjqCag0YBlr3Ikvb7QU1K/3x', '2022-11-24', 'Thursday', '12:00', '13:00', 'Inactive'),
(7, 1, 'SUUyWXRSUUI5RitlNmRpRkFGdm9TZz09OjpwjLupYiRQkyHGQmkt/dSd', 'SWRpUEE0amZ2TjFFam9rOXJsczl1Zz09OjqCag0YBlr3Ikvb7QU1K/3x', '2022-11-24', 'Thursday', '13:00', '14:00', 'Inactive'),
(8, 1, 'SUUyWXRSUUI5RitlNmRpRkFGdm9TZz09OjpwjLupYiRQkyHGQmkt/dSd', 'SWRpUEE0amZ2TjFFam9rOXJsczl1Zz09OjqCag0YBlr3Ikvb7QU1K/3x', '2022-11-24', 'Thursday', '14:00', '15:00', 'Inactive'),
(9, 1, 'SUUyWXRSUUI5RitlNmRpRkFGdm9TZz09OjpwjLupYiRQkyHGQmkt/dSd', 'SWRpUEE0amZ2TjFFam9rOXJsczl1Zz09OjqCag0YBlr3Ikvb7QU1K/3x', '2022-11-24', 'Thursday', '15:00', '16:00', 'Active'),
(10, 1, 'SUUyWXRSUUI5RitlNmRpRkFGdm9TZz09OjpwjLupYiRQkyHGQmkt/dSd', 'SWRpUEE0amZ2TjFFam9rOXJsczl1Zz09OjqCag0YBlr3Ikvb7QU1K/3x', '2022-11-24', 'Thursday', '16:00', '17:00', 'Active'),
(11, 1, 'SUUyWXRSUUI5RitlNmRpRkFGdm9TZz09OjpwjLupYiRQkyHGQmkt/dSd', 'SWRpUEE0amZ2TjFFam9rOXJsczl1Zz09OjqCag0YBlr3Ikvb7QU1K/3x', '2022-11-24', 'Thursday', '17:00', '18:00', 'Active'),
(12, 1, 'SUUyWXRSUUI5RitlNmRpRkFGdm9TZz09OjpwjLupYiRQkyHGQmkt/dSd', 'SWRpUEE0amZ2TjFFam9rOXJsczl1Zz09OjqCag0YBlr3Ikvb7QU1K/3x', '2022-11-24', 'Thursday', '18:00', '19:00', 'Active'),
(13, 1, 'SUUyWXRSUUI5RitlNmRpRkFGdm9TZz09OjpwjLupYiRQkyHGQmkt/dSd', 'SWRpUEE0amZ2TjFFam9rOXJsczl1Zz09OjqCag0YBlr3Ikvb7QU1K/3x', '2022-11-24', 'Thursday', '20:00', '21:00', 'Active'),
(14, 2, 'Y1hFUTI3d3MzdDk5c2ZpTHRHRlE2dz09OjqGlSmvQsAuTCaoIajIKTHY', 'ZmxuTzRGd21rRHg3WDFOZlJML09QQT09Ojr6rK5MyuEgaoKuL3efbWLM', '2022-11-24', 'Thursday', '10:00', '11:00', 'Active'),
(15, 2, 'Y1hFUTI3d3MzdDk5c2ZpTHRHRlE2dz09OjqGlSmvQsAuTCaoIajIKTHY', 'ZmxuTzRGd21rRHg3WDFOZlJML09QQT09Ojr6rK5MyuEgaoKuL3efbWLM', '2022-11-24', 'Thursday', '11:00', '12:00', 'Active'),
(16, 2, 'Y1hFUTI3d3MzdDk5c2ZpTHRHRlE2dz09OjqGlSmvQsAuTCaoIajIKTHY', 'ZmxuTzRGd21rRHg3WDFOZlJML09QQT09Ojr6rK5MyuEgaoKuL3efbWLM', '2022-11-24', 'Thursday', '12:00', '13:00', 'Active'),
(17, 2, 'Y1hFUTI3d3MzdDk5c2ZpTHRHRlE2dz09OjqGlSmvQsAuTCaoIajIKTHY', 'ZmxuTzRGd21rRHg3WDFOZlJML09QQT09Ojr6rK5MyuEgaoKuL3efbWLM', '2022-11-24', 'Thursday', '13:00', '14:00', 'Active'),
(18, 2, 'Y1hFUTI3d3MzdDk5c2ZpTHRHRlE2dz09OjqGlSmvQsAuTCaoIajIKTHY', 'ZmxuTzRGd21rRHg3WDFOZlJML09QQT09Ojr6rK5MyuEgaoKuL3efbWLM', '2022-11-24', 'Thursday', '14:00', '15:00', 'Inactive'),
(19, 2, 'Y1hFUTI3d3MzdDk5c2ZpTHRHRlE2dz09OjqGlSmvQsAuTCaoIajIKTHY', 'ZmxuTzRGd21rRHg3WDFOZlJML09QQT09Ojr6rK5MyuEgaoKuL3efbWLM', '2022-11-24', 'Thursday', '15:00', '16:00', 'Active'),
(20, 2, 'Y1hFUTI3d3MzdDk5c2ZpTHRHRlE2dz09OjqGlSmvQsAuTCaoIajIKTHY', 'ZmxuTzRGd21rRHg3WDFOZlJML09QQT09Ojr6rK5MyuEgaoKuL3efbWLM', '2022-11-24', 'Thursday', '16:00', '17:00', 'Active'),
(21, 2, 'Y1hFUTI3d3MzdDk5c2ZpTHRHRlE2dz09OjqGlSmvQsAuTCaoIajIKTHY', 'ZmxuTzRGd21rRHg3WDFOZlJML09QQT09Ojr6rK5MyuEgaoKuL3efbWLM', '2022-11-24', 'Thursday', '17:00', '18:00', 'Active'),
(22, 2, 'Y1hFUTI3d3MzdDk5c2ZpTHRHRlE2dz09OjqGlSmvQsAuTCaoIajIKTHY', 'ZmxuTzRGd21rRHg3WDFOZlJML09QQT09Ojr6rK5MyuEgaoKuL3efbWLM', '2022-11-24', 'Thursday', '18:00', '19:00', 'Active'),
(23, 2, 'Y1hFUTI3d3MzdDk5c2ZpTHRHRlE2dz09OjqGlSmvQsAuTCaoIajIKTHY', 'ZmxuTzRGd21rRHg3WDFOZlJML09QQT09Ojr6rK5MyuEgaoKuL3efbWLM', '2022-11-24', 'Thursday', '20:00', '21:00', 'Active'),
(24, 1, 'SUUyWXRSUUI5RitlNmRpRkFGdm9TZz09OjpwjLupYiRQkyHGQmkt/dSd', 'SWRpUEE0amZ2TjFFam9rOXJsczl1Zz09OjqCag0YBlr3Ikvb7QU1K/3x', '2022-11-25', 'Friday', '10:00', '11:00', 'Active'),
(25, 1, 'SUUyWXRSUUI5RitlNmRpRkFGdm9TZz09OjpwjLupYiRQkyHGQmkt/dSd', 'SWRpUEE0amZ2TjFFam9rOXJsczl1Zz09OjqCag0YBlr3Ikvb7QU1K/3x', '2022-11-25', 'Friday', '11:00', '12:00', 'Active'),
(26, 1, 'SUUyWXRSUUI5RitlNmRpRkFGdm9TZz09OjpwjLupYiRQkyHGQmkt/dSd', 'SWRpUEE0amZ2TjFFam9rOXJsczl1Zz09OjqCag0YBlr3Ikvb7QU1K/3x', '2022-11-25', 'Friday', '12:00', '13:00', 'Active'),
(27, 1, 'SUUyWXRSUUI5RitlNmRpRkFGdm9TZz09OjpwjLupYiRQkyHGQmkt/dSd', 'SWRpUEE0amZ2TjFFam9rOXJsczl1Zz09OjqCag0YBlr3Ikvb7QU1K/3x', '2022-11-25', 'Friday', '13:00', '14:00', 'Active'),
(28, 1, 'SUUyWXRSUUI5RitlNmRpRkFGdm9TZz09OjpwjLupYiRQkyHGQmkt/dSd', 'SWRpUEE0amZ2TjFFam9rOXJsczl1Zz09OjqCag0YBlr3Ikvb7QU1K/3x', '2022-11-25', 'Friday', '14:00', '15:00', 'Active'),
(29, 1, 'SUUyWXRSUUI5RitlNmRpRkFGdm9TZz09OjpwjLupYiRQkyHGQmkt/dSd', 'SWRpUEE0amZ2TjFFam9rOXJsczl1Zz09OjqCag0YBlr3Ikvb7QU1K/3x', '2022-11-25', 'Friday', '15:00', '16:00', 'Active'),
(30, 1, 'SUUyWXRSUUI5RitlNmRpRkFGdm9TZz09OjpwjLupYiRQkyHGQmkt/dSd', 'SWRpUEE0amZ2TjFFam9rOXJsczl1Zz09OjqCag0YBlr3Ikvb7QU1K/3x', '2022-11-25', 'Friday', '16:00', '17:00', 'Active'),
(31, 1, 'SUUyWXRSUUI5RitlNmRpRkFGdm9TZz09OjpwjLupYiRQkyHGQmkt/dSd', 'SWRpUEE0amZ2TjFFam9rOXJsczl1Zz09OjqCag0YBlr3Ikvb7QU1K/3x', '2022-11-25', 'Friday', '17:00', '18:00', 'Active'),
(32, 1, 'SUUyWXRSUUI5RitlNmRpRkFGdm9TZz09OjpwjLupYiRQkyHGQmkt/dSd', 'SWRpUEE0amZ2TjFFam9rOXJsczl1Zz09OjqCag0YBlr3Ikvb7QU1K/3x', '2022-11-25', 'Friday', '18:00', '19:00', 'Active'),
(33, 1, 'SUUyWXRSUUI5RitlNmRpRkFGdm9TZz09OjpwjLupYiRQkyHGQmkt/dSd', 'SWRpUEE0amZ2TjFFam9rOXJsczl1Zz09OjqCag0YBlr3Ikvb7QU1K/3x', '2022-11-25', 'Friday', '20:00', '21:00', 'Active'),
(34, 2, 'Y1hFUTI3d3MzdDk5c2ZpTHRHRlE2dz09OjqGlSmvQsAuTCaoIajIKTHY', 'ZmxuTzRGd21rRHg3WDFOZlJML09QQT09Ojr6rK5MyuEgaoKuL3efbWLM', '2022-11-25', 'Friday', '10:00', '11:00', 'Active'),
(35, 2, 'Y1hFUTI3d3MzdDk5c2ZpTHRHRlE2dz09OjqGlSmvQsAuTCaoIajIKTHY', 'ZmxuTzRGd21rRHg3WDFOZlJML09QQT09Ojr6rK5MyuEgaoKuL3efbWLM', '2022-11-25', 'Friday', '11:00', '12:00', 'Active'),
(36, 2, 'Y1hFUTI3d3MzdDk5c2ZpTHRHRlE2dz09OjqGlSmvQsAuTCaoIajIKTHY', 'ZmxuTzRGd21rRHg3WDFOZlJML09QQT09Ojr6rK5MyuEgaoKuL3efbWLM', '2022-11-25', 'Friday', '12:00', '13:00', 'Active'),
(37, 2, 'Y1hFUTI3d3MzdDk5c2ZpTHRHRlE2dz09OjqGlSmvQsAuTCaoIajIKTHY', 'ZmxuTzRGd21rRHg3WDFOZlJML09QQT09Ojr6rK5MyuEgaoKuL3efbWLM', '2022-11-25', 'Friday', '13:00', '14:00', 'Active'),
(38, 2, 'Y1hFUTI3d3MzdDk5c2ZpTHRHRlE2dz09OjqGlSmvQsAuTCaoIajIKTHY', 'ZmxuTzRGd21rRHg3WDFOZlJML09QQT09Ojr6rK5MyuEgaoKuL3efbWLM', '2022-11-25', 'Friday', '14:00', '15:00', 'Active'),
(39, 2, 'Y1hFUTI3d3MzdDk5c2ZpTHRHRlE2dz09OjqGlSmvQsAuTCaoIajIKTHY', 'ZmxuTzRGd21rRHg3WDFOZlJML09QQT09Ojr6rK5MyuEgaoKuL3efbWLM', '2022-11-25', 'Friday', '15:00', '16:00', 'Active'),
(40, 2, 'Y1hFUTI3d3MzdDk5c2ZpTHRHRlE2dz09OjqGlSmvQsAuTCaoIajIKTHY', 'ZmxuTzRGd21rRHg3WDFOZlJML09QQT09Ojr6rK5MyuEgaoKuL3efbWLM', '2022-11-25', 'Friday', '16:00', '17:00', 'Active'),
(41, 2, 'Y1hFUTI3d3MzdDk5c2ZpTHRHRlE2dz09OjqGlSmvQsAuTCaoIajIKTHY', 'ZmxuTzRGd21rRHg3WDFOZlJML09QQT09Ojr6rK5MyuEgaoKuL3efbWLM', '2022-11-25', 'Friday', '17:00', '18:00', 'Active'),
(42, 2, 'Y1hFUTI3d3MzdDk5c2ZpTHRHRlE2dz09OjqGlSmvQsAuTCaoIajIKTHY', 'ZmxuTzRGd21rRHg3WDFOZlJML09QQT09Ojr6rK5MyuEgaoKuL3efbWLM', '2022-11-25', 'Friday', '18:00', '19:00', 'Active'),
(43, 2, 'Y1hFUTI3d3MzdDk5c2ZpTHRHRlE2dz09OjqGlSmvQsAuTCaoIajIKTHY', 'ZmxuTzRGd21rRHg3WDFOZlJML09QQT09Ojr6rK5MyuEgaoKuL3efbWLM', '2022-11-25', 'Friday', '20:00', '21:00', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `medicineID` int NOT NULL,
  `MedicineName` varchar(100) NOT NULL,
  `Description` varchar(600) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`medicineID`, `MedicineName`, `Description`) VALUES
(1, 'ibuprofen', 'Ibuprofen is a nonsteroidal anti-inflammatory drug (NSAID). It works by reducing hormones that cause inflammation and pain in the body. Ibuprofen is used to reduce fever and treat pain or inflammation caused by many conditions such as headache, toothache, back pain, arthritis, menstrual cramps, or minor injury. Ibuprofen is used in adults and children who are at least 6 months old.'),
(2, 'paracetamol', 'Paracetamol (Panadol, Calpol, Alvedon) is an analgesic and antipyretic drug that is used to temporarily relieve mild-to-moderate pain and fever. It is commonly included as an ingredient in cold and flu medications and is also used on its own. Paracetamol is exactly the same drug as acetaminophen (Tylenol).'),
(3, 'oxacillin', 'Oxacillin is a penicillin antibiotic that fights bacteria in the body. Oxacillin is used to treat many different types of infections caused by staphylococcus (also called \"staph\" infection).'),
(4, 'abilify', 'Abilify is an antipsychotic medication. It works by changing the actions of chemicals in the brain. Abilify is used to treat the symptoms of psychotic conditions including schizophrenia in adults and children at least 13 years old. Abilify is also used alone or with a mood stabilizer medicine to treat bipolar I disorder (manic depression) in adults and children at least 10 years old. Abilify is used with antidepressant medication to treat major depressive disorder in adults.');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patientID` int NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `DOB` date NOT NULL,
  `Telephone` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `userID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patientID`, `FirstName`, `LastName`, `Address`, `DOB`, `Telephone`, `userID`) VALUES
(1, 'bFp1T1gyaG5EdzR1MFYwRXB6RjdoZz09OjoYFMzztTdjCOr4gbS7OLh5', 'U3ptTkxkSzhtdERUcFpJWnN3dFdodz09OjqOKPlV9BNP7/+rX5gIQhmm', 'cnR0Ny9yb1dPQzBtMXdxeTBMSHNyQT09Ojo0qJHO/cYWtQvuk0UCKPWJ', '1994-04-06', 'eVd6UjI0OElxUzBaaE5VeHBVTW5OQT09OjrHknuL6fO4KAm2dJ0CnQ3B', 4),
(2, 'QXZ5cXJMSGgxbGJLTlhCTXYzVGs0QT09Ojoq6vlTdUVjCvDylLE0TX07', 'N24vdnl0bFhDTWtyWDdRVWJtaWpBQT09Ojqz1ZlSLmQpw/I0nU6s4eJq', 'bGVKaG5DZVJHRDUxUEJhMXk0ZzhCUT09OjogKFhWUmaVGT0BgbkMoBuU', '2001-11-09', 'VHpuSFRGK3dScUpBL1NoRW5MWCtWdz09Ojq5NNRHsLPFkcd2kdplPI6C', 5),
(3, 'YkloaVVaT2xmY3Q5dUIwWUNCbFBjQT09OjqB3N3V3GsqyGvexecsikK4', 'b01uZG5tSW96NHlGMDFseXdEZEN2dz09OjpAV6jJtSqcm3YuovNROiVa', 'Y3FQdW12N0pjcHJ5Q2tnbjN3YldDQT09OjpWD24S8l+IUzXt59QiTr97', '1983-01-22', 'YVlXMHROQnh4WVk0dFh1d0plMHMzQT09Ojr5ExThzF4cjDQ3hpMdbhTN', 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int NOT NULL,
  `username` varchar(100) NOT NULL,
  `userpassword` varchar(100) NOT NULL,
  `user_type` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `userpassword`, `user_type`) VALUES
(1, 'Y0hLcmxnSytYa04vcGxQZ094WndVblZ0MjBDU0pSeFZtOGsraWVZaW9BMD06Op5SzdZmX0b9dNctwJPptXI=', 'UGhpMjIvWURoRnhUQlM2c0swck1KVzNrdm9kanU0Y2JYM0I1cmR3UDdZUT06OnJFpyMNSphdPMGuzQ9Rafw=', 'ADMIN'),
(2, 'ZEhDNUlJR2REUkNhbGkxLzBkMXNCK0xEOGZGd3ZRZ3pHTnQxUXhBQ2gxRT06OthClOlZnULRAHfB++9wxLw=', 'MEIrTWhKcDU0UGNFZ2F0MjB5a0NTN0tJWVRUZ2FPelEyMmZ1UTdrR0pJOD06OhFdrjYzOjS1/jzjpDnlKa0=', 'DOCTOR'),
(3, 'RmQ3R2RzeVg5cVlub25SOXhURFlIdz09OjqVIYFNcbFPCJl/u3Hv6sBB', 'K3J3NEdQL1g3cTB3S2ZaZXJaWUJnUT09OjpV11//tGFrxOI/khLMX/dH', 'DOCTOR'),
(4, 'SWdGdmJZZEQ3Z0xMZVVFTFo2aFNIdz09Ojr8+zS73HOCIxNfdqgTozKp', 'aVYvbEliVDFoeGZJeWw0VzlnVlQvdz09OjpD/W18OjtCcuK7KMm/y369', 'PATIENT'),
(5, 'cGFkWnJka0RnMUtURk0xRmw0bVhPcVNZUDhXZVJiQW1XSUlSdWo4Ukc5OD06Op5oRJFqhmRrcZ5GlHqee5E=', 'a2h6NkV1Y1V6emUwVTVPaTA1cEo3YmNSbU4vbEw3ZzNTRWtsSEdGalJDOD06Op2Smxj9j66M2xv8ONafKTc=', 'PATIENT'),
(6, 'QWtzdXg0MERIejZ2WGRXWC9odnZEQT09OjpZtNt4t4okm2FJggboAlKG', 'VDllTU5XNFMxL0hsUjYyMVVGV1Bhdz09Ojo0LNnPN0f6hg16ss7TSvKF', 'PATIENT');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`),
  ADD KEY `users_adminFK` (`userID`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointmentID`),
  ADD KEY `doctor_apFK` (`doctorID`),
  ADD KEY `patient_apFK` (`patientID`),
  ADD KEY `sc_apFK` (`doctorscheduleID`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctorID`),
  ADD KEY `users_doctorFK` (`userID`);

--
-- Indexes for table `doctor_schedule_table`
--
ALTER TABLE `doctor_schedule_table`
  ADD PRIMARY KEY (`doctorscheduleID`),
  ADD KEY `doctor_dsFK` (`doctorID`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`medicineID`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patientID`),
  ADD KEY `users_patientFK` (`userID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointmentID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doctorID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `doctor_schedule_table`
--
ALTER TABLE `doctor_schedule_table`
  MODIFY `doctorscheduleID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `medicineID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patientID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `users_adminFK` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `sc_apFK` FOREIGN KEY (`doctorscheduleID`) REFERENCES `doctor_schedule_table` (`doctorscheduleID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `users_doctorFK` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doctor_schedule_table`
--
ALTER TABLE `doctor_schedule_table`
  ADD CONSTRAINT `doctor_dsFK` FOREIGN KEY (`doctorID`) REFERENCES `doctor` (`doctorID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `users_patientFK` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
