CREATE TABLE `urls` (
  `id` int(11) UNSIGNED NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `short_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `urls` (`id`, `url`, `short_url`) VALUES
(1, 'https://google.com', 'test');

ALTER TABLE `urls`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `urls`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
