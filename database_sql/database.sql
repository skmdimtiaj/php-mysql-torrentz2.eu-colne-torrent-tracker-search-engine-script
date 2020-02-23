--
-- Table structure for table `torrents`
--

CREATE TABLE IF NOT EXISTS `torrents` (
  `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `file_id` varchar(100) NOT NULL UNIQUE,
  `hash_id` varchar(100) NOT NULL,
  `title` varchar(200) NOT NULL,
  `title2` varchar(200) NOT NULL,
  `slug` varchar(250) NOT NULL,
  `slug2` varchar(250) NOT NULL,
  `category` varchar(100) NOT NULL,
  `size` varchar(15) NOT NULL,
  `views` varchar(10) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
