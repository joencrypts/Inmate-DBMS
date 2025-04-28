-- Create tables
CREATE TABLE IF NOT EXISTS `admin` (
  `name` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cell_location` (
  `cell_no` char(4) NOT NULL,
  `block_no` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cleaner` (
  `cno` char(4) NOT NULL,
  `cname` varchar(20) NOT NULL,
  `DOB` date NOT NULL,
  `sex` varchar(6) NOT NULL,
  `starting_date` date NOT NULL,
  `caddress` varchar(20) NOT NULL,
  `assigned_cellno` char(4) NOT NULL,
  PRIMARY KEY (`cno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `guard` (
  `gno` char(5) NOT NULL,
  `gname` varchar(20) NOT NULL,
  `DOB` date NOT NULL,
  `address` varchar(20) NOT NULL,
  `starting_date` date NOT NULL,
  `sex` varchar(8) NOT NULL,
  `assigned_block` char(4) NOT NULL,
  `shift` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`gno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `prisoner` (
  `pno` char(4) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `admit_date` date NOT NULL,
  `DOB` date NOT NULL,
  `address` varchar(20) NOT NULL,
  `crime` varchar(20) NOT NULL,
  `sex` varchar(6) NOT NULL,
  `ptype` varchar(20) NOT NULL,
  `duration` varchar(30) NOT NULL,
  `cellno` char(4) NOT NULL,
  PRIMARY KEY (`pno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Insert sample data
INSERT INTO `admin` (`name`, `password`) VALUES
('anurag', 'prakash'),
('bharat', 'naganath'),
('ninad', 'rao'),
('shanu', 'kumar');

INSERT INTO `cleaner` (`cno`, `cname`, `DOB`, `sex`, `starting_date`, `caddress`, `assigned_cellno`) VALUES
('1000', 'Nitin', '1998-11-12', 'Male', '2000-11-12', 'Goa', '1100'),
('2000', 'Anurag', '1999-11-12', 'Male', '2000-11-12', 'dsadsa', '5767'),
('3333', 'Adriel', '1996-08-06', 'Male', '2005-06-08', 'Udupi', '1001'),
('6969', 'Anany Sagar', '1998-11-11', 'Male', '2018-10-20', 'Patna', '@@@@');

INSERT INTO `guard` (`gno`, `gname`, `DOB`, `address`, `starting_date`, `sex`, `assigned_block`, `shift`, `password`) VALUES
('1111', 'Askal', '1997-11-13', 'Goa', '2000-11-12', 'Female', '8888', 'Morning', 'icecream');

INSERT INTO `prisoner` (`pno`, `Name`, `admit_date`, `DOB`, `address`, `crime`, `sex`, `ptype`, `duration`, `cellno`) VALUES
('1111', 'Anurag', '2000-11-12', '1997-11-13', 'Patna', 'Murder', 'Male', 'Minimum security', '2 Months', '9999'); 