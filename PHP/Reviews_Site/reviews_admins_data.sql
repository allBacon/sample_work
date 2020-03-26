-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2016 at 08:52 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reviews`
--
CREATE DATABASE IF NOT EXISTS `reviews` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `reviews`;

-- --------------------------------------------------------

--
-- Table structure for table `cat`
--

CREATE TABLE `cat` (
  `id` int(11) NOT NULL,
  `type` varchar(200) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cat`
--

INSERT INTO `cat` (`id`, `type`, `description`) VALUES
(1, 'car', 'cars have 4 wheels'),
(2, 'suv', 'SUV hs often 4-wheel drive'),
(3, 'truck', 'Trucks commonly have a cargo bed for hauling'),
(4, 'van', 'Vans are large passenger vehicles commonly equipped with 3 seat rows');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `comment` varchar(5000) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `review_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `make`
--

CREATE TABLE `make` (
  `id` int(11) NOT NULL,
  `manufacturer` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `make`
--

INSERT INTO `make` (`id`, `manufacturer`) VALUES
(1, 'Audi'),
(2, 'GMC'),
(3, 'Kia'),
(4, 'Chevrolet');

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE `model` (
  `id` int(11) NOT NULL,
  `model_name` char(100) NOT NULL,
  `year` int(11) NOT NULL,
  `make_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`id`, `model_name`, `year`, `make_id`, `cat_id`) VALUES
(1, 'R8', 2017, 1, 1),
(2, 'Yukon Denali', 2016, 2, 2),
(3, 'Sportage', 2017, 3, 2),
(4, 'Silverado', 2016, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `youtube_embed_link` varchar(200) NOT NULL,
  `image_links` varchar(200) NOT NULL,
  `review_meta` varchar(1000) NOT NULL,
  `review_content` varchar(8000) NOT NULL,
  `published_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `model_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `active_post` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `title`, `youtube_embed_link`, `image_links`, `review_meta`, `review_content`, `published_time`, `updated_time`, `model_id`, `user_id`, `cat_id`, `active_post`) VALUES
(1, '2017 Audi R8 V10', 'cVFkreHsTHI', '', 'After skipping a year, the R8 has been reinvented. At 610 hp, it''s Audi''s most powerful production car ever, sharing half its components with the R8 LMS race car.', '<p>Before a production version of the Audi R8 ever existed, racing fans were very familiar with it. Audi began racing the R8 Prototype at the 24 Hours of Le Mans in 2000, winning in its first time out and building a legacy of excellence over the next five years. The production car followed in 2008, proving Audi could build a sleek, mid-engine machine with the looks and performance of a supercar.</p>\r\n\r\n\r\n<p>Now Audi is releasing the second-generation R8 as a 2017 model on the Modular Sportscar System (MSS) platform that also underpins the Huracan from corporate partner Lamborghini. A mostly aluminum spaceframe, MSS also uses carbon fiber to provide extra rigidity to the firewall and central tunnel. The structure is about 70 pounds lighter than that of the outgoing R8, contributing to an overall weight loss of roughly 110 pounds. It also boasts 40 percent more torsional stiffness, thanks in part to a pair of X braces, one on top of the engine and one behind it.</p>\r\n\r\n\r\n<p>The new R8’s looks are an evolution of the stunning first-generation model. It has the low-slung stance of a supercar, with the cab pushed forward and the coupe body sloping back in a continuous arch to the rear spoiler. Audi has put a greater emphasis on horizontal lines, making the car 1.6 inches wider, and giving the sides wider shoulders. Those shoulders now interrupt the familiar side blades, making these design flourishes two pieces each instead of one. The grille is also flatter and wider, and its trapezoidal shape creates a natural flow into the wedge-shaped LED headlights.</p>\r\n\r\n<p>The R8 is initially offered in V10 and V10 Plus models. Both come with updated versions of the 5.2-liter V-10 engine. Horsepower is now 540 for the V10 and 610 for the V10 plus. Audi says fuel economy improves by 13 percent due to the addition of cylinder deactivation and a sailing feature that eliminates engine braking at low speeds.</p>\r\n\r\n\r\n<p>While the outgoing model also offers a 4.2-liter V-8, the 2017 R8 does not. Audi’s twin-turbo 4.0-liter V-8 or a smaller force-fed engine may be offered in the future. Likewise, the 6-speed manual transmission also doesn’t return. That leaves just Audi’s S Tronic 7-speed dual-clutch gearbox as standard equipment.</p>\r\n\r\n\r\n<p>The V10 model is well-equipped with such features as Nappa leather and black Alcantara headliners, heated 18-way, power-adjustable sport seats, LED interior lighting, Audi’s MMI Plus with Navigation infotainment system, magnetic ride damper control, and 19-inch alloy wheels. The V10 Plus adds racing bucket seats and carbon ceramic brakes, but gives up the magnetic ride dampers for stiffer shocks and steel springs.</p>\r\n\r\n\r\n<p>Notable options include an active dynamic steering with variable assist and variable ratios, and 20-inch wheels.</p>\r\n<p>The R8’s unique combination of advanced engineering and luxury amenities make it a supercar that can be driven every day. The ride is amazingly supple for a car with the R8’s track capability, especially with the magnetic ride dampers. The seating position is a bit upright, creating excellent front sight lines, and the cabin is finished with Audi levels of care. That translates to quality materials, impeccable fit and finish, and the latest electronics. Among those features is an updated MMI infotainment system with the brand''s new virtual cockpit, which moves the information screen from the center stack to the instrument panel.</p>\r\n\r\n<p>But a supercar is about performance, and the R8 delivers. The V-10 rockets the car from 0 to 60 mph in about 3.5 seconds in the V10 model and just over three seconds in the V10 Plus. The power is ever-present and relentless when you get on the throttle, but the engine is also docile when the Audi Drive Select system is in the Comfort or Auto modes. The revs stay high in Dynamic mode and a launch control feature lets drivers repeat those quick 0 to 60 mph times over and over again.</p>\r\n\r\n<p>Audi’s S Tronic transmission is appropriate for a supercar. Like the engine, the shifts are relaxed in Comfort or Auto and crisp and quick in the Dynamic mode. You’ll go around a track faster using this transmission than a manual, but we still pine for the gated metal shifter of the first-gen R8.</p>\r\n\r\n<p>With its combination of style, on-road comfort, power, and track-ready handling, the 2017 Audi R8 is a worthy competitor for the likes of the McLaren 650S, Mercedes-Benz AMG GT, Porsche 911 Turbo, and even the Chevrolet Corvette Z06. A less-expensive base model, likely to be added later in the model year, will only expand its appeal.</p>\r\n\r\n<p>The EPA rates the coupe at 14 mpg city, 22 highway, 17 combined, while the Spyder manages the same numbers.</p>', '2016-04-20 23:20:00', '0000-00-00 00:00:00', 1, 1, 1, 1),
(2, '2016 GMC Yukon Denali - Best of Both Worlds', 'FukIKDqmIqg', '', 'Step inside the 2016 Yukon Denali and experience the large-SUV standard for refinement and innovation. With three rows of first-class seating, your passengers will enjoy the same style and comfort that you do.\r\n', '<p>In 1999, we liked a girl at high school because her mom would give us rides in her loaded, cherry-red GMC Yukon XL Denali. In fact, GMC’s very first Denali that year—meant to lure mega-SUV intenders away from the new-for-’98 Lincoln Navigator—came in a color just like the new Crimson Red Tintcoat shown on the 2016 Yukon XL Denali pictured here.</p>\r\n\r\n<p>Completely overhauled for 2015, the Yukon, stretched Yukon XL, and their upscale Denali versions carry over for 2016 like Ma$e and Puffy never went off the radio. New options include an Enhanced Driver Alert Package, which adds active lane-keeping assist and auto high beams to the forward-collision alert, lane-departure warning, and vibrating-seat alerts that are standard on SLT and Denali models and optional on the base SLE. SLT and Denali models now offer a White Frost Tricoat and standard foot-sensing power tailgate, while capless refueling comes to all Yukon models.</p>\r\n\r\n<p>Were six different 22-inch wheel choices not enough for you? GMC has cast another two sets, just in case. (And they’re heavy as cement shoes. Ask us how we know.) Also, since these big GM trucks usually land on the annual “Most Stolen Cars” list, the 2016 Yukon makes it tougher to jimmy open the liftgate and has improved towing sensors—provided you order the Enhanced Security Package.</p>', '2016-05-15 05:18:10', '0000-00-00 00:00:00', 2, 2, 2, 1),
(3, '2017 Kia Sportage SX Turbo 2.0L FWD', 'JF0fTgo3tcs', '', 'The Kia Sportage has been redesigned both inside and out for the 2017 model year. Just when you thought all crossovers have descended into a sea of sameness; in strolls the new Sportage with a face like nothing we have seen thus far. Kia’s design has taken a leap for the better with a more luxurious interior. There are 3 levels of trim starting with the base LX FWD model that costs $22,990 up to the SX Turbo AWD model that costs $34,000.', '<p>\r\nEvery once in a while, a mainstream automaker turns out an unexpected sleeper, an under-the-radar vehicle with the power to dispatch flashier rides pulling away from a stoplight. Sleepers come in many forms, but few offer better cover than compact crossovers. The <a href="/reviews/toyota-rav4-limited-4wd-v-6-road-test" target="_self">2006–2012 Toyota RAV4 with the optional 268-hp V-6 engine</a> was a good example, as were the stick-shift, turbocharged Subaru Forester XT and Kia’s previous-generation Sportage SX with its 260-hp turbo four-cylinder. Toyota’s fire-breathing RAV4 was extinguished in 2012 and the Forester is now stuck with a CVT, but Kia’s hot turbocharged SX trim level is back and in form following <a href="/reviews/2017-kia-sportage-first-drive-review" target="_self">the Sportage’s redesign for 2017</a>, and for the first time we’ve tested it without the optional all-wheel drive. \r\n</p>\r\n<h3><b>Quickie Kia</b></h3>\r\n<p>\r\nSecretly quick cars are fun, but the outgoing Sportage SX had its share of shortcomings outside of its rowdy engine. The suspension was downright harsh, the interior simply was there, and it returned middling fuel economy. For the latest SX, the sportiest Sportage in the lineup, Kia retained the hot-rod-in-disguise aspect while improving nearly everything else. The crossover’s turbocharged four-cylinder engine pushes 240 horsepower and 260 lb-ft (that’s a 59-hp and 85 lb-ft bump over the base model’s naturally aspirated 2.4-liter four) shot our front-drive SX to 60 mph in 6.7 seconds and on to an electronically governed 135 mph. Those numbers best everything in the compact-crossover melee excepting the <a href="/reviews/2016-subaru-forester-20xt-test-review" target="_self">Subaru Forester 2.0XT</a>, which comes only in all-wheel-drive form. \r\n</p>\r\n\r\n<p>\r\nIn an effort to improve the carryover turbo engine’s fuel efficiency and smooth the lumpy power delivery, Kia stripped it of 20 horsepower and 9 lb-ft of torque, to mixed effect. The engine still issues its might with a strong surge at about 3000 rpm, but even indulging ourselves with the accelerator pedal we saw 21 mpg in mixed driving, which is also the EPA city mileage rating. Something near 30 mpg seems achievable on the highway. The true vice is one shared among all high-output, front-drive vehicles: torque steer and a penchant for spinning the front tires under hard acceleration. We’d splurge for the optional ($1500) all-wheel-drive system, even though it piles on an extra 119 pounds and adds 0.2 second to the zero-to-60-mph time. We like power—see our affection for the old SX, which <a href="/reviews/2012-kia-sportage-sx-awd-long-term-test-review" target="_self">we put through a 40,000-mile long-term test</a>—but 240 ponies are a lot to shove through the same two wheels that also handle steering duties.\r\n</p>\r\n\r\n<p>\r\nDrive the Kia like a workaday compact crossover, rather than a tiny Porsche Cayenne, and the turbo engine makes a better case for itself by yanking around the SX with relaxed aplomb. It never feels wanting for passing power, and the chassis is buttoned-down and stable. Critically, compared with the old SX, which came standard with a “sport suspension,” Kia tuned this new SX model’s chassis to be more compliant, like that of the regular Sportage, without sacrificing body control. The brakes are reassuring and returned stops from 70 mph in 173 feet, good for this class. Outside of some flutter from the big 19-inch wheels when passing over closely spaced groupings of road imperfections and an utter lack of feel from the steering, the SX chassis performs well while riding quietly and smoothly even at highway speeds. \r\n</p>\r\n\r\n<h3><b>Kia Can-Do</b></h3>\r\n<p>\r\nWhile the Sportage’s fun quotient survived the redesign, its previously austere, if functional, interior was shown the door. The new cabin is well executed, to the point that it garnered from our staff several flattering comparisons to those of Audi vehicles. The design is restrained and the dashboard and door panels feature classy soft-touch materials and quality plastics. We especially like the nice-to-hold steering wheel and the center stack’s slight cant toward the driver. Rear-seat passengers have plenty of legroom, although their seat cushions are positioned a tad low, and they have ready access to a 12-volt power plug and a USB slot. The cargo hold is large and basically rectangular; the rear seats can fold completely flat using release buttons next to the outboard headrests. Those seats lack release handles readily accessible from the cargo bay, but the load floor back there can be fitted to one of two heights; when in the lower position, there’s a built-in ramp to provide a smooth transition to the folded seatbacks. \r\n</p>', '2016-05-22 01:28:31', '0000-00-00 00:00:00', 3, 1, 2, 1),
(4, '2016 Chevy Silverado 3500 HD', 'huiOVfGDYew', '', '2016 Chevy Silverado HD 3500 Dually Takes on The Extreme Ike Gauntlet towing test. This dually is equipped with the 6.6L V8 Duramax turbo-diesel, 6-speed Allison transmission, and 3.73 rear-axle gears. It produces 765 lb-ft of torque, which is less than the competition. Can it match the Ram 3500 HD on the hill?', ' <p>The &quot;HD&quot; part of Chevrolet Silverado 3500HD does  not, in fact, indicate that this truck features crystal-clear wide-screen  picture quality. In this case we''re using the old-fashioned meaning of HD:  &quot;Heavy Duty.&quot; Thanks to its stiffened suspension, sturdy frame,  powerful engine choices and available dual rear wheels, the 3500HD is a true  workhorse meant for serious towing and hauling. Having said that, the latest  model does offer an HD-quality 8-inch touchscreen, so it''s not the one-trick  pony it used to be.</p>\r\n<p>Indeed, the Silverado 3500HD has evolved into a  multitalented star. Compared to past Silverado trucks, the current model boasts  a radically improved interior that enhances this big pickup''s desirability. Nonetheless,  it will always be the durable, capable mechanicals underneath that keep generations  of Chevy loyalists coming back to the gold bowtie. The original definition of  &quot;HD&quot; is alive and well in Chevy''s toughest truck.</p>\r\n<p><strong>Current Chevrolet  Silverado 3500HD</strong><br>\r\n  The current Silverado 3500HD has been redesigned for the  2015 model year. Like the 2500HD, it shares its comprehensively upgraded  interior layout and technology features with the latest Silverado 1500. The  exterior styling has also been updated to bear a family resemblance to the  1500. As expected, regular-, extended- or crew-cab body styles are offered, but  the extended cab has been reinvented, featuring a new official name  (&quot;double cab&quot;) and four conventional doors rather than the traditional  reverse-opening rear doors. The regular and double cabs come with a long cargo  box only, while the crew cab offers either a short box or a long box.</p>\r\n<p>The powertrains are borrowed from the previous generation, so  a 6.0-liter V8 with 360 horsepower and 380 pound-feet of torque is the standard  engine. A &quot;bi-fuel&quot; option permits this V8 to use compressed natural  gas (CNG), with CNG output falling to 301 hp and 333 lb-ft. Either way, a  six-speed automatic transmission handles the shifting duties. The optional 6.6-liter  Duramax diesel V8 (397 hp, 765 lb-ft) continues to be paired with an exclusive  Allison six-speed automatic. Every 3500HD can be equipped with either rear- or  four-wheel drive, and all cab styles can be outfitted with a dual-rear-wheel  setup. An automatic locking rear differential is standard across the board.</p>\r\n<p>The double- and crew-cab body styles have three trim levels  -- Work Truck, LT and LTZ -- while the regular cab is limited to Work Truck and  LT trims. Standard equipment is more generous than ever on the Work Truck,  including cruise control and an audio system with a 4.2-inch color display and  USB connectivity. The &quot;WT&quot; also provides basics like a front bench  seat, steel wheels, a tilt-only steering wheel and air-conditioning. The LT throws  in alloy wheels, tinted glass, heated power mirrors, an &quot;EZ-Lift and  Lower&quot; tailgate, cloth upholstery, OnStar, MyLink smartphone integration,  Bluetooth phone connectivity and a six-speaker CD audio system with satellite  radio. The LTZ cranks up the luxury with foglights, extended chrome trim,  leather upholstery (with optional power front bucket seats), heated front  seats, dual-zone automatic climate control, a rearview camera and an 8-inch  MyLink touchscreen.</p>\r\n<p>Some of the 3500HD''s upscale standard features are optional  on lesser trims. Other options include power-adjustable pedals, front and rear  parking sensors, a tilt-and-telescoping steering wheel, a heated steering  wheel, Bose audio and the Z71 Off-Road package with special suspension  components. New for this 3500HD is the High Country package, which matches high-end  rival models with a saddle-brown leather interior and basically every premium  feature in the book. Also new are optional safety technologies like  lane-departure warning and forward-collision alert.</p>\r\n<p>In terms of towing and hauling capability, the current  Silverado 3500HD isn''t much more capable than its predecessor. The engines are  the same, after all, and although the structure has been reinforced here and  there, it was already extremely stout. The interior, however, is a giant leap  for Chevy-kind. The formerly crude Work Truck dashboard looks downright respectable  these days, while the LTZ''s leather trim and 8-inch touchscreen would do a  luxury SUV proud. We''ve been knocking the 3500HD''s lackluster cabin  appointments for years, but now they''re fully up to snuff. We''re also fans of  the new double cab with its four normal doors; it''s a &quot;Why didn''t they  think of that before?&quot; kind of idea (of course, Ram thought of it years  ago with its Quad Cab). Throw in the monstrous, battle-tested Duramax diesel,  and you''ve got a full-spectrum product that''s tough to top. But trucks in this  class are always jockeying for pole position, so don''t sleep on the latest from  Ford and Ram.<strong></strong></p>\r\n<p><strong>Used Chevrolet  Silverado 3500HD Models</strong><br>\r\n  The previous-generation Chevy Silverado 3500HD was produced  for the 2007-''14 model years. Although its appearance remained largely  unchanged, the 2011-''14 truck gained a stronger, fully boxed frame, beefier  suspension components and additional electronic aids. The standard engine was  initially a 6.0-liter gasoline V8 that made 353 hp and 373 lb-ft of torque,  while the 6.6-liter Duramax diesel was rated at 365 hp and 660 lb-ft. The gas  V8 crept up to 360 hp and 380 lb-ft for 2010; the Duramax, meanwhile, was overhauled  for 2011 and re-rated at 397 hp and 765 lb-ft. Both engines had a six-speed  automatic transmission, with the diesel upgrading to an Allison unit with  manual shift control.</p>', CURRENT_TIMESTAMP, '0000-00-00 00:00:00', 4, 1, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `freq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `profile` varchar(100) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active_user` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `first_name`, `last_name`, `email`, `profile`, `avatar`, `date_created`, `active_user`) VALUES
(1, 'Dan', 'Dan', 'Benson', 'dan@gmail.com', '', '', '2016-05-21 10:32:48', 1),
(2, 'the_burb', 'Tom', 'Burbank', 'theburb@gmail.com', '', '', '2016-05-25 06:06:20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usercredentials`
--

CREATE TABLE `usercredentials` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `password` varchar(40) NOT NULL,
  `administrator` tinyint(1) NOT NULL,
  `passwordSalt` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usercredentials`
--

INSERT INTO `usercredentials` (`id`, `user_id`, `password`, `administrator`, `passwordSalt`) VALUES
(1, 1, 'a5a07adcf10b942341a4172823eb34a52610f424', 1, 'WVADuhT8'),
(2, 2, 'ab7b580792ff68857c97b0252d394a3c4034a702', 1, 'qeOUT13y');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cat`
--
ALTER TABLE `cat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Comments_Reviews` (`review_id`),
  ADD KEY `Comments_Users` (`user_id`);

--
-- Indexes for table `make`
--
ALTER TABLE `make`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Model_Categories` (`cat_id`),
  ADD KEY `Model_Make` (`make_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `Reviews_Model` (`model_id`),
  ADD KEY `Reviews_Users` (`user_id`),
  ADD KEY `review_cat` (`cat_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usercredentials`
--
ALTER TABLE `usercredentials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Users_UserCredentials` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cat`
--
ALTER TABLE `cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `make`
--
ALTER TABLE `make`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `usercredentials`
--
ALTER TABLE `usercredentials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `Comments_Reviews` FOREIGN KEY (`review_id`) REFERENCES `review` (`review_id`),
  ADD CONSTRAINT `Comments_Users` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `model`
--
ALTER TABLE `model`
  ADD CONSTRAINT `Model_Categories` FOREIGN KEY (`cat_id`) REFERENCES `cat` (`id`),
  ADD CONSTRAINT `Model_Make` FOREIGN KEY (`make_id`) REFERENCES `make` (`id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `Reviews_Model` FOREIGN KEY (`model_id`) REFERENCES `model` (`id`),
  ADD CONSTRAINT `Reviews_Users` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `review_cat` FOREIGN KEY (`cat_id`) REFERENCES `cat` (`id`);

--
-- Constraints for table `usercredentials`
--
ALTER TABLE `usercredentials`
  ADD CONSTRAINT `Users_UserCredentials` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
