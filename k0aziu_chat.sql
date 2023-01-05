SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
--
-- Baza danych: `k0aziu_chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `user` varchar(30) NOT NULL,
  `sentTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nick` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `admin` tinyint(4) NOT NULL,
  `lastSeen` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `user` (`id`, `nick`, `password`, `admin`, `lastSeen`) VALUES
(1, 'k0aziu', 'p455w0rd', 1, '01:01:01'),
(2, 'test', 'test', 0, '12:11:45'),
(3, 'user', 'user', 0, '03:54:11');

ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;