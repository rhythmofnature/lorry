CREATE TABLE `bur_trips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_of_travel` datetime NOT NULL,
  `vehicle_id` varchar(200) DEFAULT NULL,
  `driver_id` varchar(200) DEFAULT NULL,
  `lorry_owner_phone` varchar(100) DEFAULT NULL,
  `lorry_owner` varchar(100) DEFAULT NULL,
  `driver_phone` varchar(100) DEFAULT NULL,
  `material_id` varchar(200) DEFAULT NULL,
  `size` varchar(100) NOT NULL,
  `measurement_type` int(11) NOT NULL,
  `merchant` int(11) NOT NULL DEFAULT '0',
  `buyer` varchar(200) DEFAULT NULL,
  `site_name` varchar(250) NOT NULL,
  `site_place` varchar(250) NOT NULL DEFAULT '',
  `kilometre` varchar(100) NOT NULL,
  `vehicle_rent` float(8,2) NOT NULL,
  `driver_amount` int(11) NOT NULL DEFAULT '0',
  `merchant_amount` int(11) NOT NULL DEFAULT '0',
  `buyer_amount` int(11) NOT NULL DEFAULT '0',
  `buyer_amount_total` int(11) NOT NULL DEFAULT '0',
  `buyer_trip_sheet_number` varchar(20) NOT NULL,
  `seller_trip_sheet_number` varchar(20) NOT NULL DEFAULT '',
  `ready_merchant` enum('no','yes') NOT NULL DEFAULT 'no',
  `ready_buyer` enum('no','yes') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM
