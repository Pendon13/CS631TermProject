/* Customer */
INSERT INTO `customer` (`fname`, `minit`, `lname`, `haddress`, `phone`, `creditcard`, `email`)
    VALUES  ('John', 'A', 'Smith', '816 Washington Ave, Hoboken, NJ', '2015551822', '1234123412341234', 'johnsmith@example.com'),
            ('Jane', NULL, 'Doe', '51 Franklin Rd, East Brunswick, NJ', '2015558162', '2345234523452345', 'janedow@example.com'),
            ('Mark', 'S', 'Hale', '321 Moat Dr, Paramus, NJ', '2015558261', '3456345634563456', 'markhale@example.com'),
            ('Sam', 'B', 'Roberts', '61 Englewood St, Trenton, NJ', '2015557162', '4567456745674567', 'samroberts@example.com'),
            ('Jay', NULL, 'Dale', '12 Broad St, Newark, NJ', '2015557281', '5678567856785678', 'jaydale@example.com');
/* Vehicle */
INSERT INTO `vehicle` (`vin`, `cust_id`, `model`, `make_year`, `color`, `vehicle_type`, `manufacturer`)
    VALUES  ('111111', '1', 'Camry', '2010', 'Blue', 'Car', 'Toyota'),
            ('121111', '1', 'Volt', '2022', 'Blue', 'Car', 'Chevrolet'),
            ('211111', '2', 'CRV', '2020', 'Black', 'Van', 'Honda'),
            ('311111', '3', 'Civic', '2010', 'Blue', 'Car', 'Honda'),
            ('411111', '4', 'Y', '2020', 'Blue', 'Car', 'Tesla'),
            ('511111', '5', 'Mustang', '2010', 'Blue', 'Truck', 'Ford');
/* Location */
INSERT INTO `businesslocation` (`loc_address`) 
    VALUES  ('Newark, NJ'), 
            ('Trenton, NJ'), 
            ('Hoboken, NJ'), 
            ('Paramus, NJ'), 
            ('East Brunswick, NJ');
/* Employee */
INSERT INTO `employee` (`ssn`, `loc_id`, `fname`, `minit`, `lname`, `haddress`, `hire_date`)
    VALUES  ('123456789', '1', 'Michael', 'X', 'Hal', '123 Newark St, Newark, NJ', '2023-04-10'),
            ('223456789', '1', 'Michelle', 'X', 'Dal', '122 Newark St, Newark, NJ', '2023-03-10'),
            ('323456789', '2', 'Dale', '', 'Mol', '123 Newark St, Newark, NJ', '2023-04-10'),
            ('423456789', '2', 'Dave', '', 'Lao', '122 Newark St, Newark, NJ', '2023-03-10');
/* Manager */
INSERT INTO `manager` (`emp_ssn`, `salary`)
    VALUES  ('123456789', '50000');
/* Technician*/
INSERT INTO `technician` (`emp_ssn`, `hourly_rate`)
    VALUES  ('223456789', '14.50');
/* Skill */
INSERT INTO `skill` (`skill_name`)
    VALUES  ('Oil change'), 
            ('Front-end alignment'),
            ('Brake'),
            ('Tire repair and replacement'),
            ('Engine tune-up'),
            ('Vehicle computer diagnostic'),
            ('State vehicle inspection');
/* Technician has Skill */
INSERT INTO `technicianhasskill` (`tech_ssn`, `skill_id`)
    VALUES  ('223456789', '1'),
            ('223456789', '2'),
            ('223456789', '3'),
            ('223456789', '4'),
            ('223456789', '5'),
            ('223456789', '6'),
            ('223456789', '7');
/* Part */
INSERT INTO `part` (`part_name`, `price`)
    VALUES  ('Engine', '300'),
            ('Oil', '5');
/* Inventory */
INSERT INTO `inventory` (`quantity`, `part_id`, `loc_id`)
    VALUES  ('2', '1', '1');
/* Services Offered */
INSERT INTO `servicesoffered` (`svc_type`, `vehicle_type`, `skill_id`, `price`)
    VALUES  ('Oil Change', 'Car', '1', '50'),
            ('Front-end alignment', 'Car', '2', '75'),
            ('Brake', 'Car', '3', '200'),
            ('Tire repair and replacement', 'Car', '4', '60'),
            ('Engine tune-up', 'Car', '5', '80'),
            ('Vehicle computer diagnostic', 'Car', '6', '100'),
            ('State vehicle inspection', 'Car', '7', '10'),
            ('Oil Change', 'Van', '1', '75'),
            ('Front-end alignment', 'Van', '2', '100'),
            ('Brake', 'Van', '3', '300'),
            ('Tire repair and replacement', 'Van', '4', '70'),
            ('Engine tune-up', 'Van', '5', '150'),
            ('Vehicle computer diagnostic', 'Van', '6', '100'),
            ('State vehicle inspection', 'Van', '7', '10'),
            ('Oil Change', 'Truck', '1', '50'),
            ('Front-end alignment', 'Truck', '2', '100'),
            ('Brake', 'Truck', '3', '400'),
            ('Tire repair and replacement', 'Truck', '4', '100'),
            ('Engine tune-up', 'Truck', '5', '200'),
            ('Vehicle computer diagnostic', 'Truck', '6', '200'),
            ('State vehicle inspection', 'Truck', '7', '20');
/* Part Used In Service */
INSERT INTO `partusedinservice` (`part_id`, `service_id`)
    VALUES  ('2', '1');
/* Appointment */
INSERT INTO `appointment` (`appt_date`, `loc_id`, `cust_id`, `vin`)
    VALUES  ('2023-04-27', '1', '1', '111111');
/* Invoice */
INSERT INTO `invoice` (`amount`, `date_paid`)
    VALUES  ('200', '2023-04-27');
/* Invoice Details */
INSERT INTO `invoicedetails` (`appt_id`, `service_id`, `invoice_id`, `price`, `status`)
    VALUES  ('1', '1', '1', '200', 'Paid');