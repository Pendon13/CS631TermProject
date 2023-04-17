/* Customer */
INSERT INTO `customer` (`id`, `fname`, `minit`, `lname`, `haddress`, `phone`, `creditcard`, `email`)
    VALUES  (NULL, 'John', 'A', 'Smith', '816 Washington Ave, Hoboken, NJ', '2015551822', '1234123412341234', 'johnsmith@example.com'),
            (NULL, 'Jane', NULL, 'Doe', '51 Franklin Rd, East Brunswick, NJ', '2015558162', '2345234523452345', 'janedow@example.com'),
            (NULL, 'Mark', 'S', 'Hale', '321 Moat Dr, Paramus, NJ', '2015558261', '3456345634563456', 'markhale@example.com'),
            (NULL, 'Sam', 'B', 'Roberts', '61 Englewood St, Trenton, NJ', '2015557162', '4567456745674567', 'samroberts@example.com'),
            (NULL, 'Jay', NULL, 'Dale', '12 Broad St, Newark, NJ', '2015557281', '5678567856785678', 'jaydale@example.com');
/* Vehicle */

/* Part */

/* Employees */

/* Locations */
INSERT INTO `businesslocation` (`loc_address`) 
    VALUES  ('Newark, NJ'), 
            ('Trenton, NJ'), 
            ('Hoboken, NJ'), 
            ('Paramus, NJ'), 
            ('East Brunswick, NJ');