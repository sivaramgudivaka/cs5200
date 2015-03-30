CREATE TABLE `user` (
  `firstName` varchar(45) DEFAULT NULL,
  `lastName` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `dateOfBirth` DATE NOT NULL,
  PRIMARY KEY (`username`)
);

CREATE TABLE `comment` (
'id' varchar(45) NOT NULl,
 `comment` TEXT DEFAULT NULL,
 `date` DATE DEFAULT CURRENT_TIMESTAMP,
  `username` int(11) DEFAULT NULL,
  `movie` varchar(45) DEFAULT NULL,
  FOREIGN KEY (`movie`) REFERENCES `movie` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION
  PRIMARY KEY (`id`)
);

CREATE TABLE `movie` (
  `id` varchar(256) NOT NULL,
  `title` varchar(256) DEFAULT NULL,
  `posterImage` varchar(256) DEFAULT NULL,
  `releaseDate` DATE NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `actor` (
  `id` varchar(45) NOT NULL,
  `firstName` varchar(45) DEFAULT NULL,
  `lastName` varchar(45) DEFAULT NULL,
  `dateOfBirth` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `cast` (
  `id` varchar(45) NOT NULL,
  `actorId` varchar(45) NOT NULL,
  `movie` varchar(45) DEFAULT NULL,
  `characterName` varchar(45) DEFAULT NOT NULL,
  FOREIGN KEY (`movie`) REFERENCES `movie` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  FOREIGN KEY (`actorId`) REFERENCES `actor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
  PRIMARY KEY (`id`)
);