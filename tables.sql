CREATE TABLE IF NOT EXISTS `animals` (
  `animal_name` varchar(11),
  `pupulation` INT(8),
  `type` varchar(11),
  PRIMARY KEY (`animal_name`)
)

CREATE TABLE IF NOT EXISTS `Part_Of` (
  `animal_name` varchar(32) PRIMARY KEY,
  `exhibit_name` varchar(32)
)

CREATE TABLE IF NOT EXISTS `Exhibit` (
  `exhibit_name` varchar(32) PRIMARY KEY,
  `details` varchar(32)
)

CREATE TABLE IF NOT EXISTS `Held_In` (
  `schedule_ID` INT(16) PRIMARY KEY,
  `exhibit_name` varchar(32),
)

CREATE TABLE IF NOT EXISTS `Event_Schedule` (
  `event_ID` INT(16) PRIMARY KEY,
  `datetime` varchar(32),
)

CREATE TABLE IF NOT EXISTS `Has` (
  `event_name` varchar(32) PRIMARY KEY,
  `schedule_ID` INT(16)
)

CREATE TABLE IF NOT EXISTS `Event` (
  `event_name` varchar(32) PRIMARY KEY,
  `group_size` INT(8)
)