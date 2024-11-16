const countryData = [
    { country: 'Andorra', regions: ['Andorra la Vella', 'Canillo', 'Encamp', 'Escaldes-Engordany', 'La Massana', 'Ordino', 'Sant Julià de Lòria'] },
    { country: 'French Southern and Antarctic Lands', regions: [] },
    { country: 'Laos', regions: ['Attapeu', 'Bokeo', 'Bolikhamsai', 'Champasak', 'Houaphanh', 'Khammouane', 'Luang Namtha', 'Luang Prabang', 'Oudomxay', 'Phongsaly', 'Salavan', 'Savannakhet', 'Sekong', 'Vientiane', 'Xaisomboun', 'Xaisomboun', 'Xiangkhouang'] },
    { country: 'Canada', regions: ['Alberta', 'British Columbia', 'Manitoba', 'New Brunswick', 'Newfoundland and Labrador', 'Nova Scotia', 'Ontario', 'Prince Edward Island', 'Quebec', 'Saskatchewan'] },
    { country: 'Nigeria', regions: ['Abia', 'Adamawa', 'Akwa Ibom', 'Anambra', 'Bauchi', 'Bayelsa', 'Benue', 'Borno', 'Cross River', 'Delta', 'Ebonyi', 'Edo', 'Ekiti', 'Enugu', 'Gombe', 'Imo', 'Jigawa', 'Kaduna', 'Kano', 'Katsina', 'Kebbi', 'Kogi', 'Kwara', 'Lagos', 'Nasarawa', 'Niger', 'Ogun', 'Ondo', 'Osun', 'Oyo', 'Plateau', 'Rivers', 'Sokoto', 'Taraba', 'Yobe', 'Zamfara'] },
    { country: 'Vanuatu', regions: ['Malampa', 'Penama', 'Sanma', 'Shefa', 'Tafea', 'Torba'] },
    { country: 'Czechia', regions: ['Prague', 'Central Bohemia', 'South Bohemia', 'Plzeň', 'Karlovy Vary', 'Ústí nad Labem', 'Liberec', 'Hradec Králové', 'Pardubice', 'Vysočina', 'South Moravia', 'Olomouc', 'Zlín', 'Moravia-Silesia'] },
    { country: 'Malawi', regions: ['Central Region', 'Northern Region', 'Southern Region'] },
    { country: 'Mali', regions: ['Bamako', 'Kayes', 'Koulikoro', 'Sikasso', 'Ségou', 'Mopti', 'Tombouctou', 'Gao', 'Kidal'] },
    { country: 'Iceland', regions: ['Capital Region', 'Southern Peninsula', 'Western Region', 'Westfjords', 'Northwest Region', 'Northeast Region', 'Eastfjords', 'South Iceland'] },
    { country: 'Norway', regions: ['Viken', 'Oslo', 'Innlandet', 'Vestfold og Telemark', 'Agder', 'Rogaland', 'Vestland', 'Møre og Romsdal', 'Trøndelag', 'Nordland', 'Troms og Finnmark'] },
    { country: 'Saint Vincent and the Grenadines', regions: ['Charlotte', 'Grenadines', 'Saint Andrew', 'Saint David', 'Saint George', 'Saint Patrick'] },
    { country: 'Guadeloupe', regions: ['Basse-Terre', 'Pointe-à-Pitre'] },
    { country: 'Chile', regions: ['Arica y Parinacota', 'Tarapacá', 'Antofagasta', 'Atacama', 'Coquimbo', 'Valparaíso', 'Metropolitana de Santiago', "O’Higgins", 'Maule', 'Ñuble', 'Biobío', 'La Araucanía', 'Los Ríos', 'Los Lagos', 'Aysén del General Carlos Ibáñez del Campo', 'Magallanes y de la Antártica Chilena'] },
    { country: 'Bermuda', regions: ['Devonshire', 'Hamilton', 'Paget', 'Pembroke', 'Sandys', "Smith's", 'Southampton', "St. George's", 'Warwick'] },
    { country: 'Kuwait', regions: ['Al Asimah', 'Hawalli', 'Farwaniya', 'Mubarak Al-Kabeer', 'Ahmadi', 'Jahra'] },
    { country: 'Dominica', regions: ['Saint Andrew', 'Saint David', 'Saint George', 'Saint John', 'Saint Joseph', 'Saint Luke', 'Saint Mark', 'Saint Patrick'] },
    { country: 'Montenegro', regions: ['Andrijevica', 'Bar', 'Berane', 'Bijelo Polje', 'Budva', 'Cetinje', 'Danilovgrad', 'Gusinje', 'Herceg Novi', 'Kolašin', 'Kotor', 'Mojkovac', 'Nikšić', 'Plav', 'Pljevlja', 'Plužine', 'Podgorica', 'Rožaje', 'Šavnik', 'Tivat', 'Ulcinj', 'Žabljak'] },
    { country: 'United States Virgin Islands', regions: ['Saint Croix', 'Saint John', 'Saint Thomas'] },
    { country: 'Cameroon', regions: ['Adamaoua', 'Centre', 'East', 'Far North', 'Littoral', 'North', 'Northwest', 'South', 'Southwest', 'West'] },
    { country: 'Sri Lanka', regions: ['Central', 'Eastern', 'North Central', 'Northern', 'North Western', 'Sabaragamuwa', 'Southern', 'Uva', 'Western'] },
    { country: 'China', regions: ['Anhui', 'Fujian', 'Gansu', 'Guangdong', 'Guizhou', 'Hainan', 'Hebei', 'Heilongjiang', 'Henan', 'Hubei', 'Hunan', 'Jiangsu', 'Jiangxi', 'Jilin', 'Liaoning', 'Qinghai', 'Shaanxi', 'Shandong', 'Shanghai', 'Shanxi', 'Sichuan', 'Tianjin', 'Xinjiang', 'Xizang (Tibet)', 'Yunnan', 'Zhejiang'] },
    { country: 'Bangladesh', divisions: ['Barisal', 'Chittagong', 'Dhaka', 'Khulna', 'Mymensingh', 'Rajshahi', 'Rangpur', 'Sylhet'] },
    { country: 'Sweden', regions: ['Blekinge', 'Dalarna', 'Gotland', 'Gävleborg', 'Halland', 'Jämtland', 'Jönköping', 'Kalmar', 'Kronoberg', 'Norrbotten', 'Örebro', 'Östergötland', 'Skåne', 'Södermanland', 'Stockholm', 'Uppsala', 'Värmland', 'Västerbotten', 'Västernorrland', 'Västmanland', 'Västra Götaland'] },
    { country: 'Grenada', regions: ['Saint Andrew', 'Saint David', 'Saint George', 'Saint John', 'Saint Mark', 'Saint Patrick'] },
    { country: 'Turkey', regions: ['Aegean', 'Black Sea', 'Central Anatolia', 'Eastern Anatolia', 'Marmara', 'Mediterranean', 'Southeastern Anatolia'] },
    { country: 'Guinea', regions: ['Boké', 'Conakry', 'Faranah', 'Kankan', 'Kindia', 'Labé', 'Mamou', 'Nzérékoré'] },
    { country: 'Tanzania', regions: ['Arusha', 'Dar es Salaam', 'Dodoma', 'Geita', 'Iringa', 'Kagera', 'Katavi', 'Kigoma', 'Kilimanjaro', 'Lindi', 'Manyara', 'Mara', 'Mbeya', 'Morogoro', 'Mtwara', 'Mwanza', 'Njombe', 'Pemba North', 'Pemba South', 'Pwani', 'Rukwa', 'Ruvuma', 'Shinyanga', 'Simiyu', 'Singida', 'Tabora', 'Tanga', 'Zanzibar Central/South', 'Zanzibar North', 'Zanzibar Urban/West'] },
    { country: 'Rwanda', regions: ['Eastern', 'Kigali', 'Northern', 'Southern', 'Western'] },
    { country: 'Singapore', regions: ["Ang Mo Kio", 'Bedok', 'Bishan', 'Bukit Batok', 'Bukit Merah', 'Bukit Panjang', 'Bukit Timah', 'Central Water Catchment', 'Changi', 'Choa Chu Kang', 'Clementi', 'Downtown Core', 'Geylang', 'Hougang', 'Jurong East', 'Jurong West', 'Kallang', 'Lim Chu Kang', 'Mandai', 'Marina East', 'Marina South', 'Marine Parade', 'Museum', 'Newton', 'North-Eastern Islands', 'Novena', 'Orchard', 'Outram', 'Pasir Ris', 'Paya Lebar', 'Pioneer', 'Punggol', 'Queenstown', 'River Valley', 'Rochor', 'Sembawang', 'Sengkang', 'Serangoon', 'Simpang', 'Singapore River', 'Southern Islands', 'Straits View', 'Sungei Kadut', 'Tampines', 'Tanglin', 'Tengah', 'Toa Payoh', 'Tuas', 'Western Islands', 'Western Water Catchment', 'Woodlands', 'Yishun'] },
    { country: 'Morocco', regions: ['Béni Mellal-Khénifra', 'Casablanca-Settat', 'Draa-Tafilalet', 'Fès-Meknès', 'Guelmim-Oued Noun', 'Laâyoune-Sakia El Hamra', 'Marrakech-Safi', 'Oriental', 'Rabat-Salé-Kénitra', 'Souss-Massa', 'Tanger-Tétouan-Al Hoceima'] },
    { country: 'Saint Barthélemy', regions: ['Gustavia'] },
    { country: 'Iraq', regions: ['Al-Anbar', 'Babil', 'Baghdad', 'Basra', 'Dhi Qar', 'Diyala', 'Dohuk', 'Erbil', 'Karbala', 'Kirkuk', 'Maysan', 'Muthanna', 'Najaf', 'Nineveh', 'Salah al-Din', 'Sulaymaniyah', 'Wasit'] },
    { country: 'Brunei', regions: ['Belait', 'Brunei-Muara', 'Temburong', 'Tutong'] },
    { country: 'Isle of Man', regions: ['Douglas', 'Onchan', 'Peel', 'Ramsey'] },
    { country: 'North Korea', regions: ['Chagang', 'Hamgyong-bukto', 'Hamgyong-namdo', 'Hwanghae-bukto', 'Hwanghae-namdo', 'Kangwon-do', 'Pyongan-bukto', 'Pyongan-namdo', 'Ryanggang'] },
    { country: 'Iran', regions: ['Alborz', 'Ardabil', 'Bushehr', 'Chaharmahal and Bakhtiari', 'East Azerbaijan', 'Isfahan', 'Fars', 'Gilan', 'Golestan', 'Hormozgan', 'Ilam', 'Kerman', 'Kermanshah', 'Khuzestan', 'Kohgiluyeh and Boyer-Ahmad', 'Kurdistan', 'Lorestan', 'Markazi', 'Mazandaran', 'North Khorasan', 'Qazvin', 'Qom', 'Razavi Khorasan', 'Semnan', 'Sistan and Baluchestan', 'South Khorasan', 'Tehran', 'West Azerbaijan', 'Yazd', 'Zanjan'] },
    { country: 'Curaçao', regions: [] },
    { country: 'Paraguay', regions: ['Alto Paraguay', 'Alto Paraná', 'Amambay', 'Boquerón', 'Caaguazú', 'Caazapá', 'Canindeyú', 'Central', 'Concepción', 'Cordillera', 'Guairá', 'Itapúa', 'Misiones', 'Ñeembucú', 'Paraguarí', 'Presidente Hayes', 'San Pedro'] },
    { country: 'Albania', regions: ['Berat', 'Dibër', 'Durrës', 'Elbasan', 'Fier', 'Gjirokastër', 'Korçë', 'Kukës', 'Lezhë', 'Shkodër', 'Tiranë', 'Vlorë'] },
    { country: 'Tajikistan', regions: ['Dushanbe', 'Sughd', 'Khatlon', 'GBAO'] },
    { country: 'Bolivia', regions: ['Chuquisaca', 'Cochabamba', 'Beni', 'La Paz', 'Oruro', 'Pando', 'Potosí', 'Santa Cruz', 'Tarija'] },
    { country: 'Austria', regions: ['Burgenland', 'Carinthia', 'Lower Austria', 'Upper Austria', 'Salzburg', 'Styria', 'Tyrol', 'Vorarlberg', 'Vienna'] },
    { country: 'Saint Kitts and Nevis', regions: ['Christ Church Nichola Town', 'Saint Anne Sandy Point', 'Saint George Basseterre', 'Saint George Gingerland', 'Saint James Windward', 'Saint John Capisterre', 'Saint John Figtree', 'Saint Mary Cayon', 'Saint Paul Capisterre', 'Saint Paul Charlestown', 'Saint Peter Basseterre', 'Saint Thomas Lowland', 'Saint Thomas Middle Island', 'Trinity Palmetto Point'] },
    { country: 'United States Minor Outlying Islands', regions: ['Baker Island', 'Howland Island', 'Jarvis Island', 'Johnston Atoll', 'Kingman Reef', 'Midway Atoll', 'Palmyra Atoll', 'Wake Island'] },
    { country: 'Colombia', regions: ['Amazonas', 'Antioquia', 'Arauca', 'Atlántico', 'Bolívar', 'Boyacá', 'Caldas', 'Caquetá', 'Casanare', 'Cauca', 'Cesar', 'Chocó', 'Córdoba', 'Cundinamarca', 'Guainía', 'Guaviare', 'Huila', 'La Guajira', 'Magdalena', 'Meta', 'Nariño', 'Norte de Santander', 'Putumayo', 'Quindío', 'Risaralda', 'San Andrés and Providencia', 'Santander', 'Sucre', 'Tolima', 'Valle del Cauca', 'Vaupés', 'Vichada'] },
    { country: 'Kosovo', regions: ['Gjakova', 'Gjilan', 'Mitrovica', 'Pristina', 'Peć', 'Prizren'] },
    { country: 'Belize', regions: ['Belize', 'Cayo', 'Corozal', 'Orange Walk', 'Stann Creek', 'Toledo'] },
    { country: 'Guinea-Bissau', regions: ['Bafatá', 'Biombo', 'Bissau', 'Bolama-Bijagos', 'Cacheu', 'Gabú', 'Oio', 'Quinara', 'Tombali'] },
    { country: 'Marshall Islands', regions: ['Ailinglaplap', 'Ailuk', 'Arno', 'Aur', 'Bikini', 'Ebon', 'Enewetak', 'Jabat', 'Jaluit', 'Kili', 'Kwajalein', 'Lae', 'Lib', 'Likiep', 'Majuro', 'Maloelap', 'Mejit', 'Mili', 'Namorik', 'Namu', 'Rongelap', 'Rongrik', 'Toke', 'Ujae', 'Ujelang', 'Utirik', 'Wotho', 'Wotje'] },
    { country: 'Myanmar', divisions: ['Ayeyarwady', 'Bago', 'Chin', 'Kachin', 'Kayah', 'Kayin', 'Magway', 'Mandalay', 'Mon', 'Naypyidaw', 'Rakhine', 'Sagaing', 'Shan', 'Tanintharyi', 'Yangon'] },
    { country: 'French Polynesia', regions: ['Austral Islands', 'Gambier Islands', 'Marquesas Islands', 'Society Islands', 'Tuamotu-Gambier', 'Tuamotu Islands'] },
    { country: 'Brazil', regions: ['Acre', 'Alagoas', 'Amapá', 'Amazonas', 'Bahia', 'Ceará', 'Espírito Santo', 'Federal District', 'Goiás', 'Maranhão', 'Mato Grosso', 'Mato Grosso do Sul', 'Minas Gerais', 'Pará', 'Paraíba', 'Paraná', 'Pernambuco', 'Piauí', 'Rio de Janeiro', 'Rio Grande do Norte', 'Rio Grande do Sul', 'Rondônia', 'Roraima', 'Santa Catarina', 'São Paulo', 'Sergipe', 'Tocantins'] },
    { country: 'Croatia', regions: ['Bjelovar-Bilogora', 'Brod-Posavina', 'Dubrovnik-Neretva', 'Istria', 'Karlovac', 'Koprivnica-Križevci', 'Krapina-Zagorje', 'Lika-Senj', 'Međimurje', 'Osijek-Baranja', 'Požega-Slavonia', 'Primorje-Gorski Kotar', 'Šibenik-Knin', 'Sisak-Moslavina', 'Split-Dalmatia', 'Varaždin', 'Virovitica-Podravina', 'Vukovar-Syrmia', 'Zadar', 'Zagreb', 'Zagreb County'] },
    { country: 'Somalia', regions: ['Awdal', 'Bakool', 'Banadir', 'Bari', 'Bay', 'Galguduud', 'Gedo', 'Hiiraan', 'Jubbada Dhexe', 'Jubbada Hoose', 'Mudug', 'Nugaal', 'Sanaag', 'Shabelle Dhexe', 'Shabelle Hoose', 'Sool', 'Togdheer', 'Woqooyi Galbeed'] },
    { country: 'Afghanistan', regions: ['Badakhshan', 'Badghis', 'Baghlan', 'Balkh', 'Bamyan', 'Daykundi', 'Farah', 'Faryab', 'Ghazni', 'Ghor', 'Helmand', 'Herat', 'Jowzjan', 'Kabul', 'Kandahar', 'Kapisa', 'Khost', 'Kunar', 'Kunduz', 'Laghman', 'Logar', 'Nangarhar', 'Nimroz', 'Nuristan', 'Paktia', 'Paktika', 'Panjshir', 'Parwan', 'Samangan', 'Sar-e Pol', 'Takhar', 'Urozgan', 'Wardak', 'Zabul'] },
    { country: 'Anguilla', regions: ['Anguilla'] },
    { country: 'Cook Islands', regions: ['Aitutaki', 'Atiu', 'Mangaia', 'Manihiki', 'Mauke', 'Mitiaro', 'Nassau', 'Palmerston', 'Penrhyn', 'Pukapuka', 'Rakahanga', 'Rarotonga'] },
    { country: 'Western Sahara', regions: ['Aousserd', 'Dakhla-Oued Ed-Dahab'] },
    { country: 'New Zealand', regions: ['Northland', 'Auckland', 'Waikato', 'Bay of Plenty', 'Gisborne', "Hawke's Bay", 'Taranaki', 'Manawatū-Whanganui', 'Wellington', 'Tasman', 'Nelson', 'Marlborough', 'West Coast', 'Canterbury', 'Otago', 'Southland'] },
    { country: 'Eritrea', regions: ['Anseba', 'Central', 'Gash-Barka', 'Northern Red Sea', 'Southern Red Sea'] },
    { country: 'Cambodia', regions: ['Banteay Meanchey', 'Battambang', 'Kampong Cham', 'Kampong Chhnang', 'Kampong Speu', 'Kampong Thom', 'Kampot', 'Kandal', 'Kep', 'Koh Kong', 'Kratié', 'Mondulkiri', 'Oddar Meanchey', 'Pailin', 'Phnom Penh', 'Preah Sihanouk', 'Preah Vihear', 'Prey Veng', 'Pursat', 'Ratanakiri', 'Siem Reap', 'Stung Treng', 'Svay Rieng', 'Takéo', 'Tbong Khmum'] },
    { country: 'Bahamas', regions: ['New Providence', 'Grand Bahama', 'Abaco', 'Andros', 'Eleuthera', 'Exuma', 'Cat Island', 'Long Island', 'San Salvador', 'Acklins', 'Crooked Island', 'Mayaguana', 'Inagua', 'Bimini', 'Berry Islands'] },
    { country: 'Belarus', regions: ['Brest', 'Gomel', 'Grodno', 'Minsk', 'Mogilev', 'Vitebsk'] },
    { country: 'Norfolk Island', regions: ['Norfolk Island'] },
    { country: 'Tuvalu', regions: ['Funafuti', 'Nanumanga', 'Nanumea', 'Niutao', 'Nui', 'Nukufetau', 'Nukulaelae', 'Vaitupu'] },
    { country: 'South Georgia', regions: ['South Georgia'] },
    { country: 'Mauritania', regions: ['Adrar', 'Assaba', 'Brakna', 'Dakhlet Nouadhibou', 'Gorgol', 'Guidimaka', 'Hodh Ech Chargui', 'Hodh El Gharbi', 'Inchiri', 'Nouakchott', 'Tagant', 'Tiris Zemmour', 'Trarza'] },
    { country: 'New Caledonia', regions: ['South Province', 'North Province', 'Loyalty Islands'] },
    { country: 'Bulgaria', regions: ['Blagoevgrad', 'Burgas', 'Dobrich', 'Gabrovo', 'Haskovo', 'Kardzhali', 'Kyustendil', 'Lovech', 'Montana', 'Pazardzhik', 'Pernik', 'Pleven', 'Plovdiv', 'Razgrad', 'Ruse', 'Shumen', 'Silistra', 'Sliven', 'Smolyan', 'Sofia', 'Sofia-Grad', 'Stara Zagora', 'Targovishte', 'Varna', 'Veliko Tarnovo', 'Vidin', 'Vratsa', 'Yambol'] },
    { country: 'Mozambique', regions: ['Cabo Delgado', 'Gaza', 'Inhambane', 'Manica', 'Maputo', 'Nampula', 'Niassa', 'Sofala', 'Tete', 'Zambezia'] },
    { country: 'Niue', regions: ['Niue'] },
    { country: 'Estonia', regions: ['Harju', 'Hiiu', 'Ida-Viru', 'Järva', 'Jõgeva', 'Lääne', 'Lääne-Viru', 'Põlva', 'Pärnu', 'Rapla', 'Saare', 'Tartu', 'Valga', 'Viljandi', 'Võru'] },
    { country: 'Italy', regions: ['Abruzzo', 'Aosta Valley', 'Apulia', 'Basilicata', 'Calabria', 'Campania', 'Emilia-Romagna', 'Friuli Venezia Giulia', 'Lazio', 'Liguria', 'Lombardy', 'Marche', 'Molise', 'Piedmont', 'Sardinia', 'Sicily', 'Trentino-Alto Adige', 'Tuscany', 'Umbria', 'Veneto'] },
    { country: 'Comoros', regions: ['Anjouan', 'Grande Comore', 'Mohéli'] },
    { country: 'Mexico', regions: ['Aguascalientes', 'Baja California', 'Baja California Sur', 'Campeche', 'Chiapas', 'Chihuahua', 'Coahuila', 'Colima', 'Durango', 'Guanajuato', 'Guerrero', 'Hidalgo', 'Jalisco', 'Mexico City', 'Mexico State', 'Michoacán', 'Morelos', 'Nayarit', 'Nuevo León', 'Oaxaca', 'Puebla', 'Querétaro', 'Quintana Roo', 'San Luis Potosí', 'Sinaloa', 'Sonora', 'Tabasco', 'Tamaulipas', 'Tlaxcala', 'Veracruz', 'Yucatán', 'Zacatecas'] },
    { country: 'Ukraine', regions: ['Cherkasy', 'Chernihiv', 'Chernivtsi', 'Dnipropetrovsk', 'Donetsk', 'Ivano-Frankivsk', 'Kharkiv', 'Kherson', 'Khmelnytskyi', 'Kiev', 'Kirovohrad', 'Luhansk', 'Lviv', 'Mykolaiv', 'Odessa', 'Poltava', 'Rivne', 'Sumy', 'Ternopil', 'Vinnytsia', 'Volyn', 'Zakarpattia', 'Zaporizhia', 'Zhytomyr'] },
    { country: 'Argentina', regions: ['Buenos Aires', 'Catamarca', 'Chaco', 'Chubut', 'Córdoba', 'Corrientes', 'Entre Ríos', 'Formosa', 'Jujuy', 'La Pampa', 'La Rioja', 'Mendoza', 'Misiones', 'Neuquén', 'Río Negro', 'Salta', 'San Juan', 'San Luis', 'Santa Cruz', 'Santa Fe', 'Santiago del Estero', 'Tierra del Fuego', 'Tucumán'] },
    { country: 'Uzbekistan', regions: ['Andijan', 'Bukhara', 'Fergana', 'Jizzakh', 'Karakalpakstan', 'Namangan', 'Navoiy', 'Qashqadaryo', 'Samarqand', 'Sirdaryo', 'Surxondaryo', 'Tashkent', 'Xorazm'] },
    { country: 'Finland', regions: ['Åland Islands', 'Central Finland', 'Central Ostrobothnia', 'Eastern Finland', 'Kainuu', 'Kymenlaakso', 'Lapland', 'North Karelia', 'Northern Ostrobothnia', 'Northern Savo', 'Ostrobothnia', 'Pirkanmaa', 'South Karelia', 'Southern Ostrobothnia', 'Southern Savo', 'Uusimaa', 'Varsinais-Suomi'] },
    { country: 'Portugal', regions: ['Azores', 'Madeira', 'North', 'Center', 'Lisbon', 'Alentejo', 'Algarve'] },
    { country: 'Senegal', regions: ['Dakar', 'Diourbel', 'Fatick', 'Kaffrine', 'Kaolack', 'Kédougou', 'Kolda', 'Louga', 'Matam', 'Saint-Louis', 'Sédhiou', 'Tambacounda', 'Thiès', 'Ziguinchor'] },
    { country: 'Zimbabwe', regions: ['Bulawayo', 'Harare', 'Manicaland', 'Mashonaland Central', 'Mashonaland East', 'Mashonaland West', 'Masvingo', 'Matabeleland North', 'Matabeleland South', 'Midlands'] },
    { country: 'Maldives', regions: ['Addu Atoll', 'Alif Alif Atoll', 'Alif Dhaal Atoll', 'Baa Atoll', 'Dhaalu Atoll', 'Faafu Atoll', 'Gaafu Alif Atoll', 'Gaafu Dhaalu Atoll', 'Gnaviyani Atoll', 'Haa Alif Atoll', 'Haa Dhaalu Atoll', 'Kaafu Atoll', 'Laamu Atoll', 'Lhaviyani Atoll', 'Meemu Atoll', 'Noonu Atoll', 'Raa Atoll', 'Seenu Atoll', 'Shaviyani Atoll', 'Thaa Atoll', 'Vaavu Atoll'] },
    { country: 'Jordan', regions: ['Ajloun', 'Amman', 'Aqaba', 'Balqa', 'Irbid', 'Jerash', 'Karak', "Ma'an", 'Madaba', 'Mafraq', 'Tafilah', 'Zarqa'] },
    { country: 'Central African Republic', prefectures: ['Bamingui-Bangoran', 'Bangui', 'Basse-Kotto', 'Haut-Mbomou', 'Haute-Kotto', 'Kémo', 'Lobaye', 'Mambéré-Kadéï', 'Mbomou', 'Nana-Grebizi', 'Nana-Mambéré', "Ombella-M'Poko", 'Ouaka', 'Ouham', 'Ouham-Pendé', 'Sangha-Mbaéré', 'Vakaga'] },
    { country: 'Gambia', regions: ['Banjul', 'Central River', 'Lower River', 'North Bank', 'Upper River', 'West Coast'] },
    { country: 'Saudi Arabia', regions: ['Al Bahah', 'Al Hudud ash Shamaliyah', 'Al Jawf', 'Al Madinah', 'Al Qasim', 'Ar Riyad', 'Ash Sharqiyah', 'Asir', "Ha'il", 'Jizan', 'Makkah', 'Najran', 'Tabuk'] },
    { country: 'Dominican Republic', regions: ['Azua', 'Baoruco', 'Barahona', 'Dajabón', 'Distrito Nacional', 'Duarte', 'Elías Piña', 'El Seibo', 'Espaillat', 'Hato Mayor', 'Hermanas Mirabal', 'Independencia', 'La Altagracia', 'La Romana', 'La Vega', 'María Trinidad Sánchez', 'Monseñor Nouel', 'Monte Cristi', 'Monte Plata', 'Pedernales', 'Peravia', 'Puerto Plata', 'Samaná', 'San Cristóbal', 'San José de Ocoa', 'San Juan', 'San Pedro de Macorís', 'Sánchez Ramírez', 'Santiago', 'Santiago Rodríguez', 'Santo Domingo', 'Valverde'] },
    { country: 'Latvia', regions: ['Kurzeme', 'Latgale', 'Riga', 'Vidzeme', 'Zemgale'] },
    { country: 'Chile', regions: ['Aisén del General Carlos Ibáñez del Campo', 'Antofagasta', 'Araucanía', 'Arica y Parinacota', 'Atacama', 'Bío Bío', 'Coquimbo', 'Libertador General Bernardo O\'Higgins', 'Los Lagos', 'Los Ríos', 'Magallanes y de la Antártica Chilena', 'Maule', 'Ñuble', 'Región Metropolitana de Santiago', 'Tarapacá', 'Valparaíso'] },
    { country: 'Swaziland', regions: ['Hhohho', 'Lubombo', 'Manzini', 'Shiselweni'] },
    { country: 'Philippines', regions: ['National Capital Region', 'Cordillera Administrative Region', 'Ilocos Region', 'Cagayan Valley', 'Central Luzon', 'CALABARZON', 'MIMAROPA', 'Bicol Region', 'Western Visayas', 'Central Visayas', 'Eastern Visayas', 'Zamboanga Peninsula', 'Northern Mindanao', 'Davao Region', 'SOCCSKSARGEN', 'Caraga', 'Bangsamoro'] },
    { country: 'Turkmenistan', regions: ['Ahal', 'Balkan', 'Dasoguz', 'Lebap', 'Mary'] },
    { country: 'Guam', regions: ['Guam'] },
    { country: 'Cocos Islands', regions: ['Cocos Islands'] },
    { country: 'Kenya', regions: ['Baringo', 'Bomet', 'Bungoma', 'Busia', 'Elgeyo-Marakwet', 'Embu', 'Garissa', 'Homa Bay', 'Isiolo', 'Kajiado', 'Kakamega', 'Kericho', 'Kiambu', 'Kilifi', 'Kirinyaga', 'Kisii', 'Kisumu', 'Kitui', 'Kwale', 'Laikipia', 'Lamu', 'Machakos', 'Makueni', 'Mandera', 'Marsabit', 'Meru', 'Migori', 'Mombasa', 'Murang\'a', 'Nairobi City', 'Nakuru', 'Nandi', 'Narok', 'Nyamira', 'Nyandarua', 'Nyeri', 'Samburu', 'Siaya', 'Taita-Taveta', 'Tana River', 'Tharaka-Nithi', 'Trans Nzoia', 'Turkana', 'Uasin Gishu', 'Vihiga', 'Wajir', 'West Pokot'] },
    { country: 'Guyana', regions: ['Barima-Waini', 'Cuyuni-Mazaruni', 'Demerara-Mahaica', 'East Berbice-Corentyne', 'Essequibo Islands-West Demerara', 'Mahaica-Berbice', 'Pomeroon-Supenaam', 'Potaro-Siparuni', 'Upper Demerara-Berbice', 'Upper Takutu-Upper Essequibo'] },
    { country: 'Morocco', regions: ['Western Sahara'] },
    { country: 'French Southern and Antarctic Lands', regions: ['Adelie Land', 'Astrolabe', 'Crozet Islands', 'Kerguelen'] },
    { country: 'South Korea', metropolitanCities: ['Busan', 'Daegu', 'Daejeon', 'Gwangju', 'Incheon', 'Sejong', 'Ulsan'] },
    { country: 'Panama', regions: ['Bocas del Toro', 'Chiriquí', 'Coclé', 'Colón', 'Darién', 'Herrera', 'Los Santos', 'Panamá', 'Veraguas'] },
    { country: 'Costa Rica', regions: ['Alajuela', 'Cartago', 'Guanacaste', 'Heredia', 'Limón', 'Puntarenas', 'San José'] },
    { country: 'Tonga', divisions: ['Eua', 'Ha\'apai', 'Niuas', 'Tongatapu', 'Vava\'u'] },
    { country: 'Guatemala', regions: ['Alta Verapaz', 'Baja Verapaz', 'Chimaltenango', 'Chiquimula', 'El Progreso', 'Escuintla', 'Guatemala', 'Huehuetenango', 'Izabal', 'Jalapa', 'Jutiapa', 'Petén', 'Quetzaltenango', 'Quiché', 'Retalhuleu', 'Sacatepéquez', 'San Marcos', 'Santa Rosa', 'Sololá', 'Suchitepéquez', 'Totonicapán', 'Zacapa'] },
    { country: 'Cyprus', regions: ['Famagusta', 'Kyrenia', 'Larnaca', 'Limassol', 'Nicosia', 'Paphos'] },
    { country: 'Namibia', regions: ['Erongo', 'Hardap', 'Karas', 'Kavango East', 'Kavango West', 'Khomas', 'Kunene', 'Ohangwena', 'Omaheke', 'Omusati', 'Oshana', 'Oshikoto', 'Otjozondjupa', 'Zambezi'] },
    { country: 'Saint Pierre and Miquelon', regions: ['Saint Pierre and Miquelon'] },
    { country: 'Venezuela', regions: ['Amazonas', 'Anzoátegui', 'Apure', 'Aragua', 'Barinas', 'Bolívar', 'Carabobo', 'Cojedes', 'Delta Amacuro', 'Falcón', 'Federal Dependencies', 'Guárico', 'Lara', 'Mérida', 'Miranda', 'Monagas', 'Nueva Esparta', 'Portuguesa', 'Sucre', 'Táchira', 'Trujillo', 'Vargas', 'Yaracuy', 'Zulia'] },
    { country: 'Mali', regions: ['Bamako', 'Gao', 'Kayes', 'Kidal', 'Koulikoro', 'Mopti', 'Segou', 'Sikasso', 'Tombouctou'] },
    { country: 'Pitcairn Islands', regions: ['Pitcairn'] },
    { country: 'Greece', regions: ['Attica', 'Central Greece', 'Central Macedonia', 'Crete', 'Eastern Macedonia and Thrace', 'Epirus', 'Ionian Islands', 'North Aegean', 'Peloponnese', 'South Aegean', 'Thessaly', 'Western Greece', 'Western Macedonia'] },
    { country: 'Switzerland', cantons: ['Aargau', 'Appenzell Ausserrhoden', 'Appenzell Innerrhoden', 'Basel-Landschaft', 'Basel-Stadt', 'Bern', 'Fribourg', 'Geneva', 'Glarus', 'Graubünden', 'Jura', 'Lucerne', 'Neuchâtel', 'Nidwalden', 'Obwalden', 'Schaffhausen', 'Schwyz', 'Solothurn', 'St. Gallen', 'Thurgau', 'Ticino', 'Uri', 'Valais', 'Vaud', 'Zug', 'Zurich'] },
    { country: 'Sri Lanka', regions: ['Central', 'Eastern', 'North Central', 'Northern', 'North Western', 'Sabaragamuwa', 'Southern', 'Uva', 'Western'] },
    { country: 'Bahrain', regions: ['Capital', 'Central', 'Muharraq', 'Northern', 'Southern'] },
    { country: 'Moldova', regions: ['Bălți', 'Cahul', 'Chișinău', 'Edineț', 'Găgăuzia', 'Lăpușna', 'Orhei', 'Soroca', 'Stînga Nistrului', 'Taraclia', 'Telenești', 'Ungheni'] },
    { country: 'Honduras', regions: ['Atlántida', 'Choluteca', 'Colón', 'Comayagua', 'Copán', 'Cortés', 'El Paraíso', 'Francisco Morazán', 'Gracias a Dios', 'Intibucá', 'Islas de la Bahía', 'La Paz', 'Lempira', 'Ocotepeque', 'Olancho', 'Santa Bárbara', 'Valle', 'Yoro'] },
    { country: 'Seychelles', regions: ['Anse aux Pins', 'Anse Boileau', 'Anse Etoile', 'Anse Louis', 'Anse Royale', 'Baie Lazare', 'Baie Sainte Anne', 'Beau Vallon', 'Bel Air', 'Bel Ombre', 'Cascade', 'Glacis', "Grand'Anse", "Grand'Anse", 'La Digue', 'La Rivière Anglaise', 'Mont Buxton', 'Mont Fleuri', 'Plaisance', 'Pointe La Rue', 'Port Glaud', 'Saint Louis', 'Takamaka'] },
    { country: 'Niger', regions: ['Agadez', 'Diffa', 'Dosso', 'Maradi', 'Niamey', 'Tahoua', 'Tillabéri', 'Zinder'] },
    { country: 'Syria', regions: ['Al-Hasakah', 'Al-Raqqa', 'Aleppo', 'As-Suwayda', 'Damascus', 'Daraa', 'Deir ez-Zor', 'Hama', 'Homs', 'Idlib', 'Latakia', 'Quneitra', 'Rif Dimashq', 'Tartus'] },
    { country: 'Ivory Coast', regions: ['Abidjan', 'Bas-Sassandra', 'Comoé', 'Denguélé', 'Gôh-Djiboua', 'Lacs', 'Lagunes', 'Montagnes', 'Sassandra-Marahoué', 'Savanes', 'Vallée du Bandama', 'Woroba', 'Yamoussoukro', 'Zanzan'] },
    { country: 'Palestine', regions: ['Governorate of Bethlehem', 'Governorate of Hebron', 'Governorate of Jenin', 'Governorate of Jericho and Al Aghwar', 'Governorate of Jerusalem', 'Governorate of Nablus', 'Governorate of North Gaza', 'Governorate of Qalqilya', 'Governorate of Rafah', 'Governorate of Ramallah and Al-Bireh', 'Governorate of Salfit', 'Governorate of Tubas', 'Governorate of Tulkarm'] },
    { country: 'Trinidad and Tobago', regions: ['Arima', 'Chaguanas', 'Couva-Tabaquite-Talparo', 'Diego Martin', 'Eastern Tobago', 'Penal-Debe', 'Point Fortin', 'Port of Spain', 'Princes Town', 'San Fernando', 'San Juan-Laventille', 'Sangre Grande', 'Siparia', 'Tunapuna-Piarco', 'Western Tobago'] },
    { country: 'Cambodia', regions: ['Banteay Meanchey', 'Battambang', 'Kampong Cham', 'Kampong Chhnang', 'Kampong Speu', 'Kampong Thom', 'Kampot', 'Kandal', 'Kep', 'Koh Kong', 'Kratié', 'Mondulkiri', 'Oddar Meanchey', 'Pailin', 'Phnom Penh', 'Preah Sihanouk', 'Preah Vihear', 'Prey Veng', 'Pursat', 'Ratanakiri', 'Siem Reap', 'Stung Treng', 'Svay Rieng', 'Takéo', 'Tbong Khmum'] },
    { country: 'Nauru', regions: ['Aiwo', 'Anabar', 'Anetan', 'Anibare', 'Baiti', 'Boe', 'Buada', 'Denigomodu', 'Ewa', 'Ijuw', 'Meneng', 'Nibok', 'Uaboe', 'Yaren'] },
    { country: 'Lebanon', regions: ['Akkar', 'Baalbek-Hermel', 'Beirut', 'Beqaa', 'Mount Lebanon', 'Nabatieh', 'North Lebanon', 'South Lebanon'] },
    { country: 'Nigeria', regions: ['Abia', 'Adamawa', 'Akwa Ibom', 'Anambra', 'Bauchi', 'Bayelsa', 'Benue', 'Borno', 'Cross River', 'Delta', 'Ebonyi', 'Edo', 'Ekiti', 'Enugu', 'Federal Capital Territory', 'Gombe', 'Imo', 'Jigawa', 'Kaduna', 'Kano', 'Katsina', 'Kebbi', 'Kogi', 'Kwara', 'Lagos', 'Nasarawa', 'Niger', 'Ogun', 'Ondo', 'Osun', 'Oyo', 'Plateau', 'Rivers', 'Sokoto', 'Taraba', 'Yobe', 'Zamfara'] },
    { country: 'Croatia', regions: ['Bjelovar-Bilogora', 'Brod-Posavina', 'Dubrovnik-Neretva', 'Istria', 'Karlovac', 'Koprivnica-Križevci', 'Krapina-Zagorje', 'Lika-Senj', 'Međimurje', 'Osijek-Baranja', 'Požega-Slavonia', 'Primorje-Gorski Kotar', 'Šibenik-Knin', 'Sisak-Moslavina', 'Split-Dalmatia', 'Varaždin', 'Virovitica-Podravina', 'Vukovar-Syrmia', 'Zadar', 'Zagreb', 'Zagreb City'] },
    { country: 'Uganda', regions: ['Central', 'Eastern', 'Northern', 'Western'] },
    { country: 'Kyrgyzstan', regions: ['Batken', 'Chüy', 'Issyk-Kul', 'Jalal-Abad', 'Naryn', 'Osh', 'Talas', 'Ysyk-Köl'] },
    { country: 'Serbia', regions: ['Belgrade', 'Vojvodina', 'Šumadija and Western Serbia', 'Southern and Eastern Serbia'] },
    { country: 'French Polynesia', regions: ['Tahiti', 'Moorea-Maiao', 'Marquesas Islands', 'Tuamotu Archipelago', 'Gambier Islands', 'Austral Islands'] },
    { country: 'Burundi', regions: ['Bubanza', 'Bujumbura Mairie', 'Bujumbura Rural', 'Bururi', 'Cankuzo', 'Cibitoke', 'Gitega', 'Karuzi', 'Kayanza', 'Kirundo', 'Makamba', 'Muramvya', 'Muyinga', 'Mwaro', 'Ngozi', 'Rutana', 'Ruyigi'] },
    { country: 'Belize', regions: ['Belize', 'Cayo', 'Corozal', 'Orange Walk', 'Stann Creek', 'Toledo'] },
    { country: 'South Sudan', regions: ['Central Equatoria', 'Eastern Equatoria', 'Jonglei', 'Lakes', 'Northern Bahr el Ghazal', 'Unity', 'Upper Nile', 'Warrap', 'Western Bahr el Ghazal', 'Western Equatoria'] },
    { country: 'Lesotho', regions: ['Berea', 'Butha-Buthe', 'Leribe', 'Mafeteng', 'Maseru', 'Mohale\'s Hoek', 'Mokhotlong', 'Qacha\'s Nek', 'Quthing', 'Thaba-Tseka'] },
    { country: 'Malawi', regions: ['Balaka', 'Blantyre', 'Central Region', 'Chikwawa', 'Chiradzulu', 'Chitipa', 'Dedza', 'Dowa', 'Karonga', 'Kasungu', 'Likoma', 'Lilongwe', 'Machinga', 'Mangochi', 'Mchinji', 'Mulanje', 'Mwanza', 'Neno', 'Northern Region', 'Nsanje', 'Ntcheu', 'Nkhata Bay', 'Nkhotakota', 'Northern Region', 'Nsanje', 'Ntcheu', 'Ntchisi', 'Phalombe', 'Rumphi', 'Salima', 'Southern Region', 'Thyolo', 'Zomba'] },
    { country: 'Palau', regions: ['Aimeliik', 'Airai', 'Angaur', 'Hatohobei', 'Kayangel', 'Koror', 'Melekeok', 'Ngaraard', 'Ngarchelong', 'Ngardmau', 'Ngatpang', 'Ngchesar', 'Ngeremlengui', 'Ngiwal', 'Peleliu', 'Sonsorol'] },
    { country: 'Republic of the Congo', regions: ['Bouenza', 'Brazzaville', 'Cuvette', 'Cuvette-Ouest', 'Kouilou', 'Lékoumou', 'Likouala', 'Niari', 'Plateaux', 'Pointe-Noire', 'Pool', 'Sangha'] },
    { country: 'Romania', regions: ['North-East', 'North-West', 'Center', 'South', 'South-East', 'South-West', 'Bucharest'] },
    { country: 'Tajikistan', regions: ['Dushanbe', 'Khatlon', 'Sughd'] },
    { country: 'Zambia', regions: ['Central', 'Copperbelt', 'Eastern', 'Luapula', 'Lusaka', 'Muchinga', 'Northern', 'North-Western', 'Southern', 'Western'] },
    { country: 'Netherlands', regions: ['Drenthe', 'Flevoland', 'Friesland', 'Gelderland', 'Groningen', 'Limburg', 'Noord-Brabant', 'Noord-Holland', 'Overijssel', 'Utrecht', 'Zeeland', 'Zuid-Holland'] },
    { country: 'Bhutan', regions: ['Bumthang', 'Chhukha', 'Dagana', 'Gasa', 'Haa', 'Lhuntse', 'Mongar', 'Paro', 'Pemagatshel', 'Punakha', 'Samdrup Jongkhar', 'Samtse', 'Sarpang', 'Thimphu', 'Trashigang', 'Trashiyangtse', 'Trongsa', 'Tsirang', 'Wangdue Phodrang', 'Zhemgang'] },
    { country: 'Myanmar', regions: ['Ayeyarwady', 'Bago', 'Chin', 'Kachin', 'Kayah', 'Kayin', 'Magway', 'Mandalay', 'Mon', 'Naypyidaw', 'Rakhine', 'Sagaing', 'Shan', 'Tanintharyi', 'Yangon'] },
    { country: 'Turks and Caicos Islands', regions: ['Turks and Caicos Islands'] },
    { country: 'Anguilla', regions: ['Anguilla'] },
    { country: 'Brunei', regions: ['Belait', 'Brunei-Muara', 'Temburong', 'Tutong'] },
    { country: 'Grenada', regions: ['Saint Andrew', 'Saint David', 'Saint George', 'Saint John', 'Saint Mark', 'Saint Patrick'] },
    { country: 'Isle of Man', regions: ['Isle of Man'] },
    { country: 'Saint Barthelemy', regions: ['Saint Barthelemy'] },
    { country: 'Saint Helena', regions: ['Ascension', 'Saint Helena', 'Tristan da Cunha'] },
    { country: 'Saint Kitts and Nevis', regions: ['Christ Church Nichola Town', 'Saint Anne Sandy Point', 'Saint George Basseterre', 'Saint George Gingerland', 'Saint James Windward', 'Saint John Capisterre', 'Saint John Figtree', 'Saint Mary Cayon', 'Saint Paul Capisterre', 'Saint Paul Charlestown', 'Saint Peter Basseterre', 'Saint Thomas Lowland', 'Saint Thomas Middle Island', 'Trinity Palmetto Point'] },
    { country: 'Saint Lucia', regions: ['Anse la Raye', 'Castries', 'Choiseul', 'Dauphin', 'Dennery', 'Gros Islet', 'Laborie', 'Micoud', 'Praslin', 'Soufrière', 'Vieux Fort'] },
    { country: 'Saint Martin', regions: ['Saint Martin'] },
    { country: 'Saint Vincent and the Grenadines', regions: ['Charlotte', 'Grenadines', 'Saint Andrew', 'Saint David', 'Saint George', 'Saint Patrick'] },
    { country: 'Sint Maarten', regions: ['Sint Maarten'] },
    { country: 'Solomon Islands', regions: ['Central', 'Choiseul', 'Guadalcanal', 'Honiara', 'Isabel', 'Makira-Ulawa', 'Malaita', 'Rennell and Bellona', 'Temotu', 'Western'] },
    { country: 'South Georgia and the South Sandwich Islands', regions: ['South Georgia', 'South Sandwich Islands'] },
    { country: 'Suriname', regions: ['Brokopondo', 'Commewijne', 'Coronie', 'Marowijne', 'Nickerie', 'Para', 'Paramaribo', 'Saramacca', 'Sipaliwini', 'Wanica'] },
    { country: 'Eswatini', regions: ['Hhohho', 'Lubombo', 'Manzini', 'Shiselweni'] },
    { country: 'Svalbard', regions: ['Svalbard'] },
    { country: 'Timor-Leste', regions: ['Aileu', 'Ainaro', 'Baucau', 'Bobonaro', 'Cova Lima', 'Díli', 'Ermera', 'Lautém', 'Liquiçá', 'Manatuto', 'Manufahi', 'Oecusse', 'Viqueque'] },
    { country: 'Tokelau', regions: ['Tokelau'] },
    { country: 'Tristan da Cunha', regions: ['Tristan da Cunha'] },
    { country: 'Turkmenistan', regions: ['Ahal', 'Balkan', 'Dasoguz', 'Lebap', 'Mary'] },
    { country: 'Turks and Caicos Islands', regions: ['Turks and Caicos Islands'] },
    { country: 'Tuvalu', regions: ['Tuvalu'] },
    { country: 'Uganda', regions: ['Central', 'Eastern', 'Northern', 'Western'] },
    { country: 'Ukraine', regions: ['Cherkasy', 'Chernihiv', 'Chernivtsi', 'Dnipropetrovsk', 'Donetsk', 'Ivano-Frankivsk', 'Kharkiv', 'Kherson', 'Khmelnytskyi', 'Kiev', 'Kirovohrad', 'Luhansk', 'Lviv', 'Mykolaiv', 'Odessa', 'Poltava', 'Rivne', 'Sumy', 'Ternopil', 'Vinnytsia', 'Volyn', 'Zakarpattia', 'Zaporizhia', 'Zhytomyr'] },
    { country: 'United Arab Emirates', emirates: ['Abu Dhabi', 'Ajman', 'Dubai', 'Fujairah', 'Ras Al Khaimah', 'Sharjah', 'Umm Al Quwain'] },
    { country: 'United Kingdom', regions: ['England', 'Scotland', 'Wales', 'Northern Ireland'] },
    { country: 'United States', regions: ['Alabama', 'Alaska', 'American Samoa', 'Arizona', 'Arkansas', 'California', 'Colorado', 'Connecticut', 'Delaware', 'District of Columbia', 'Florida', 'Georgia', 'Guam', 'Hawaii', 'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana', 'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire', 'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota', 'Northern Mariana Islands', 'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Puerto Rico', 'Rhode Island', 'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'U.S. Virgin Islands', 'Utah', 'Vermont', 'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'] },
    { country: 'Uruguay', regions: ['Artigas', 'Canelones', 'Cerro Largo', 'Colonia', 'Durazno', 'Flores', 'Florida', 'Lavalleja', 'Maldonado', 'Montevideo', 'Paysandú', 'Río Negro', 'Rivera', 'Rocha', 'Salto', 'San José', 'Soriano', 'Tacuarembó', 'Treinta y Tres'] },
    { country: 'Uzbekistan', regions: ['Andijan', 'Bukhara', 'Fergana', 'Jizzakh', 'Karakalpakstan', 'Namangan', 'Navoiy', 'Qashqadaryo', 'Samarqand', 'Sirdaryo', 'Surxondaryo', 'Tashkent', 'Xorazm'] },
    { country: 'Vanuatu', regions: ['Malampa', 'Penama', 'Sanma', 'Shefa', 'Tafea', 'Torba'] },
    { country: 'Vatican City', regions: ['Vatican City'] },
    { country: 'Venezuela', regions: ['Amazonas', 'Anzoátegui', 'Apure', 'Aragua', 'Barinas', 'Bolívar', 'Carabobo', 'Cojedes', 'Delta Amacuro', 'Falcón', 'Federal Dependencies', 'Guárico', 'Lara', 'Mérida', 'Miranda', 'Monagas', 'Nueva Esparta', 'Portuguesa', 'Sucre', 'Táchira', 'Trujillo', 'Vargas', 'Yaracuy', 'Zulia'] },
    { country: 'Vietnam', regions: ['North Central Coast', 'Central Highlands', 'Mekong Delta', 'North East', 'North West', 'Red River Delta', 'South Central Coast', 'South East'] },
    { country: 'Virgin Islands (British)', regions: ['Virgin Islands'] },
    { country: 'Virgin Islands (U.S.)', regions: ['Virgin Islands'] },
    { country: 'Wallis and Futuna', regions: ['Wallis and Futuna'] },
    { country: 'Western Sahara', regions: ['Western Sahara'] },
    { country: 'Yemen', regions: ['Abyan', 'Al Bayda', 'Al Hudaydah', 'Al Jawf', 'Al Mahrah', 'Al Mahwit', 'Dhamar', 'Hadramaut', 'Hajjah', 'Ibb', 'Lahij', 'Ma\'rib', 'Raymah', 'Sa\'dah', 'Sana\'a', 'Shabwah', 'Socotra', 'Ta\'izz'] },
    { country: 'Zambia', regions: ['Central', 'Copperbelt', 'Eastern', 'Luapula', 'Lusaka', 'Muchinga', 'Northern', 'North-Western', 'Southern', 'Western'] },
    { country: 'Zimbabwe', regions: ['Bulawayo', 'Harare', 'Manicaland', 'Mashonaland Central', 'Mashonaland East', 'Mashonaland West', 'Masvingo', 'Matabeleland North', 'Matabeleland South', 'Midlands'] },
  ];

  const philippinesCities = [
    {
      region: 'National Capital Region',
      cities: [
        'Manila', 'Quezon City', 'Makati', 'Taguig', 'Pasig', 'Pasay', 'Mandaluyong', 'San Juan',
        'Caloocan', 'Malabon', 'Navotas', 'Valenzuela', 'Marikina', 'Parañaque', 'Las Piñas',
        'Muntinlupa', 'Pateros'
      ]
    },
    {
      region: 'Cordillera Administrative Region',
      cities: [
        'Baguio', 'Tabuk', 'Bontoc'
      ]
    },
    {
      region: 'Ilocos Region',
      cities: [
        'Laoag', 'Vigan', 'San Fernando', 'Candon', 'Alaminos'
      ]
    },
    {
      region: 'Cagayan Valley',
      cities: [
        'Tuguegarao', 'Cauayan', 'Ilagan'
      ]
    },
    {
      region: 'Central Luzon',
      cities: [
        'Angeles', 'San Fernando', 'Olongapo', 'Tarlac', 'Balanga', 'Malolos'
      ]
    },
    {
      region: 'CALABARZON',
      cities: [
        'Cavite City', 'Lipa', 'Batangas City', 'Tanauan', 'Calamba', 'San Pablo', 'Santa Rosa', 'Biñan',
        'Antipolo', 'Angono', 'Taytay', 'Cainta'
      ]
    },
    {
      region: 'MIMAROPA',
      cities: [
        'Puerto Princesa', 'Calapan', 'Roxas', 'Odiongan'
      ]
    },
    {
      region: 'Bicol Region',
      cities: [
        'Naga', 'Legazpi', 'Masbate City', 'Sorsogon City', 'Tabaco'
      ]
    },
    {
      region: 'Western Visayas',
      cities: [
        'Iloilo City', 'Bacolod', 'Roxas', 'Tagbilaran'
      ]
    },
    {
      region: 'Central Visayas',
      cities: [
        'Cebu City', 'Mandaue', 'Lapu-Lapu', 'Tagbilaran', 'Dumaguete'
      ]
    },
    {
      region: 'Eastern Visayas',
      cities: [
        'Tacloban', 'Ormoc', 'Calbayog', 'Maasin'
      ]
    },
    {
      region: 'Zamboanga Peninsula',
      cities: [
        'Zamboanga City', 'Dapitan', 'Dipolog', 'Pagadian'
      ]
    },
    {
      region: 'Northern Mindanao',
      cities: [
        'Cagayan de Oro', 'Iligan', 'Malaybalay', 'Valencia'
      ]
    },
    {
      region: 'Davao Region',
      cities: [
        'Davao City', 'Tagum', 'Digos', 'Panabo'
      ]
    },
    {
      region: 'SOCCSKSARGEN',
      cities: [
        'General Santos', 'Koronadal', 'Kidapawan', 'Tacurong'
      ]
    },
    {
      region: 'Caraga',
      cities: [
        'Butuan', 'Surigao City', 'Tandag', 'Bayugan'
      ]
    },
    {
      region: 'Bangsamoro',
      cities: [
        'Cotabato City', 'Marawi', 'Zamboanga City (part of Bangsamoro)'
      ]
    }
  ];

  const regionSelector = document.getElementById('edit-state');
  const selectedCountry = document.getElementById('edit-country');

  selectedCountry.addEventListener('change', function() {
  const selectedRegionIN = countryData.find(item => item.country === selectedCountry.value);

  if (selectedRegionIN) {
  let output = "";
  output += "<option>Your region</option>";
  selectedRegionIN.regions.forEach(region => {
    output += `<option>${region}</option>`;
  });

  regionSelector.innerHTML = output;
  } else {
  regionSelector.innerHTML = "<option>Your region</option>";
  }
  });

  const citySelector = document.getElementById('edit-city');
  const selectedRegion = document.getElementById('edit-state');

  selectedRegion.addEventListener('change', function() {
  const selectedRegionIN = philippinesCities.find(item => item.region === selectedRegion.value);

  if (selectedRegionIN) {
    let output = "";
    output += "<option>Your city</option>";
    selectedRegionIN.cities.forEach(region => {
      output += `<option>${region}</option>`;
    });

    citySelector.innerHTML = output;
  } else {
    citySelector.innerHTML = "<option>Your city</option>";
  }
  });

    