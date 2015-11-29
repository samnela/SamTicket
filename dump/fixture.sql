SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
 use `samticket`;
INSERT INTO `priority` (`id`, `priority`) VALUES
(1, 'low'),
(2, 'normal'),
(3, 'high'),
(4, 'emergency');


INSERT INTO `status` (`id`, `status`) VALUES
(1, 'open'),
(2, 'closed'),
(3, 'overdue');


INSERT INTO `ticket` ( `priority_id`, `status_id`, `email`, `firstname`, `lastname`, `phonenumber`, `cellnumber`, `subject`, `description`, `due_date`, `created_date`, `updated_date`) VALUES
( 2, 1, 'aa@hotmail.com', 'hello', 'nom', 60172395, 60172395, 'je c pa', 'je c pa trop', NULL, '2015-10-25 19:54:42', NULL),

--INSERT INTO `user` (`id`, `username`, `password`, `email`, `is_active`) VALUES
--(1, 'admin', '$2a$08$jHZj/wJfcVKlIwr5AvR78euJxYK7Ku5kURNhNx.7.CSIJ3Pq6LEPC', 'admin@example.com', 1);
