<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class International_ticketing_model extends CI_Model {


	public function get_airports()
	{

		$airports = array(
							"AAL" => "Aalborg",
							"AES" => "Aalesund",
							"AAR" => "Aarhus",
							"ABD" => "Abadan",
							"AEH" => "Abeche",
							"ABZ" => "Aberdeen",
							"ABR" => "Aberdeen (SD)",
							"ABJ" => "Abidjan (capital city)",
							"ABI" => "Abilene (TX)",
							"AUH" => "Abu Dhabi (capital city)",
							"ABV" => "Abuja (capital city)",
							"AUE" => "Abu Rudeis",
							"ABS" => "Abu Simbel",
							"ACA" => "Acapulco",
							"ACC" => "Accra (capital city)",
							"LCG" => "A Coruna (Corunna)",
							"ADA" => "Adana",
							"ADD" => "Addis Ababa (capital city)",
							"ADL" => "Adelaide",
							"ADE" => "Aden (capital city)",
							"ADF" => "Adiyaman",
							"AER" => "Adler/Sochi",
							"AJY" => "Agadez",
							"AGA" => "Agadir (Amazigh)",
							"GUM" => "Agana (Hagatna)",
							"AGZ" => "Aggeneys",
							"AJI" => "Agri (Agri)",
							"BQN" => "Aguadilla",
							"AGU" => "Aguascaliente",
							"AMD" => "Ahmedabad",
							"AYU" => "Aiyura",
							"AJA" => "Ajaccio",
							"AXT" => "Akita",
							"CAK" => "Akron (OH)",
							"AKT" => "Akrotiri (British Overseas Territory)",
							"AAN" => "Al Ain",
							"AAC" => "Al Arish",
							"AHU" => "Al Hoceima",
							"ALH" => "Albany",
							"ABY" => "Albany (GA)",
							"ALB" => "Albany (NY)",
							"LBI" => "Albi",
							"ABQ" => "Albuquerque (NM)",
							"ABX" => "Albury",
							"ACI" => "Alderney",
							"ALP" => "Aleppo",
							"AES" => "Alesund",
							"ALJ" => "Alexander Bay",
							"HBE" => "Alexandria [HBE]",
							"ALY" => "Alexandria [ALY]",
							"AEX" => "Alexandria (LA) [AEX]",
							"ESF" => "Alexandria (LA) [ESF]",
							"FJR" => "Alfujairah (Fujairah)",
							"AHO" => "Alghero Sassari",
							"ALG" => "Algiers (capital city)",
							"ALC" => "Alicante",
							"ASP" => "Alice Springs",
							"ADY" => "Alldays",
							"ABE" => "Allentown (PA)",
							"ALA" => "Almaty (capital city)",
							"LEI" => "Almeria",
							"ALF" => "Alta",
							"AAT" => "Altay",
							"ACH" => "Altenrhein, St. Gallen",
							"AOO" => "Altoona (PA)",
							"AXS" => "Altus (OK)",
							"ASJ" => "Amami",
							"AMA" => "Amarillo (TX)",
							"AZB" => "Amazon Bay/Deba",
							"AMM" => "Amman (capital city)",
							"ADJ" => "Amman",
							"ATQ" => "Amritsar",
							"AMS" => "Amsterdam",
							"ANC" => "Anchorage (AK)",
							"AOI" => "Ancona",
							"ALV" => "Andorra La Vella",
							"AXA" => "Anguilla/The Valley",
							"AJN" => "Anjouan",
							"ANK" => "Ankara (capital city)",
							"ESB" => "Ankara",
							"AAE" => "Annaba",
							"ARB" => "Ann Arbor",
							"NCY" => "Annecy",
							"ANB" => "Anniston (AL)",
							"AYT" => "Antalya",
							"TNR" => "Antananarivo (capital city)",
							"ANU" => "Antigua",
							"ANF" => "Antofagasta",
							"ANR" => "Antwerp",
							"AOJ" => "Aomori",
							"APW" => "Apia (capital city)",
							"ATW" => "Appelton/Neenah/Menasha",
							"AQJ" => "Aqaba",
							"AJU" => "Aracaju",
							"AQP" => "Arequipa",
							"ARH" => "Arkhangelsk",
							"ARK" => "Arusha",
							"GPA" => "Araxos/Patras",
							"RLT" => "Arlit",
							"ACE" => "Arrecife/Lanzarote",
							"AUA" => "Aruba",
							"AVL" => "Asheville",
							"ASB" => "Ashgabat (capital city)",
							"ASM" => "Asmara (capital city)",
							"ASE" => "Aspen (CO)",
							"ATZ" => "Assiut",
							"TSE" => "Astana (capital city)",
							"ASU" => "Asuncion",
							"ASW" => "Aswan",
							"ATH" => "Athens [ATH]",
							"HEW" => "Athens [HEW]",
							"AHN" => "Athens (GA) [AHN]",
							"ATO" => "Athens (OH) [ATO]",
							"ATL" => "Atlanta (GA) [ATL]",
							"ACY" => "Atlantic City (NJ)",
							"YAT" => "Attawapiskat",
							"AKL" => "Auckland",
							"AGB" => "Augsburg",
							"AGS" => "Augusta (GA)",
							"AUG" => "Augusta (ME)",
							"AUR" => "Aurillac",
							"AUS" => "Austin",
							"AYW" => "Ayawasi",
							"AYQ" => "Ayers Rock",
							"AYR" => "Ayr",
							"BCM" => "Bacau",
							"BJZ" => "Badajoz",
							"BGW" => "Bagdad (capital city)",
							"IXB" => "Bagdogra",
							"NAS" => "Bahamas",
							"BHV" => "Bahawalpur",
							"BAH" => "Bahrain (capital city)",
							"BFL" => "Bakersfield (CA)",
							"BAK" => "Baku (capital city)",
							"BPN" => "Balikpapan",
							"BNK" => "Ballina",
							"BWI" => "Baltimore (MD)",
							"ABM" => "Bamaga",
							"BKO" => "Bamako (capital city)",
							"BBY" => "Bambari",
							"BTJ" => "Banda Aceh",
							"BND" => "Bandar Abbas",
							"BWN" => "Bandar Seri Begawan(capital city)",
							"BDO" => "Bandung",
							"BLR" => "Bangalore",
							"BGU" => "Bangassou",
							"BKK" => "Bangkok (capital city)",
							"DMK" => "Bangkok [DMK]",
							"BGR" => "Bangor (ME)",
							"BGF" => "Bangui (capital city)",
							"BNX" => "Banja Luka",
							"BDJ" => "Banjarmasin",
							"BJL" => "Banjul (capital city)",
							"BNP" => "Bannu",
							"BAV" => "Baotou",
							"BCN" => "Barcelona [BCN]",
							"BLA" => "Barcelona [BLA]",
							"BDU" => "Bardufoss",
							"BRI" => "Bari",
							"BZL" => "Barisal",
							"BDQ" => "Baroda (Vadodara)",
							"BRR" => "Barra",
							"BAQ" => "Barranquilla",
							"BSL" => "Basel [BSL]",
							"EAP" => "Basel [EAP]",
							"BSR" => "Basra - (Basrah)",
							"PTP" => "Basse-Terre (administrative capital)",
							"SKB" => "Basseterre (capital city)",
							"BIA" => "Bastia",
							"BTH" => "Batam",
							"BTR" => "Baton Rouge (LA)",
							"BBM" => "Battambang",
							"BCU" => "Bauchi",
							"BYU" => "Bayreuth",
							"BPT" => "Beaumont/Pt. Arthur (TX)",
							"BVA" => "Beauvais",
							"BKW" => "Beckley (WV)",
							"EIS" => "Beef Island",
							"BHY" => "Beihai",
							"PEK" => "Beijing (capital city) [PEK]",
							"BJS" => "Beijing [BJS]",
							"NAY" => "Beijing [NAY]",
							"BEW" => "Beira",
							"BEY" => "Beirut (capital city)",
							"BEL" => "Belem",
							"BFS" => "Belfast [BFS]",
							"BHD" => "Belfast [BHD]",
							"IXG" => "Belgaum",
							"BEG" => "Belgrad (Beograd; capital city)",
							"BZE" => "Belize City",
							"BLI" => "Bellingham (WA)",
							"BCV" => "Belmopan (capital city)",
							"CNF" => "Belo Horizonte [CNF]",
							"PLU" => "Belo Horizonte [PLU]",
							"BJI" => "Bemidji (MN)",
							"BEB" => "Benbecula",
							"BEN" => "Benghazi (Bengasi)",
							"BUG" => "Benguela",
							"BNI" => "Benin City",
							"BEH" => "Benton Harbour (MI)",
							"BBT" => "Berberati",
							"BGY" => "Bergamo/Milan",
							"BGO" => "Bergen",
							"EGC" => "Bergerac",
							"BER" => "Berlin [BER]",
							"SXF" => "Berlin [SXF]",
							"TXL" => "Berlin [TXL]",
							"BDA" => "Bermuda",
							"BRN" => "Berne (capital city)",
							"BET" => "Bethel (AK)",
							"BMO" => "Bhamo",
							"BHR" => "Bharatpur",
							"BHO" => "Bhopal",
							"BBI" => "Bhubaneswar",
							"BIQ" => "Biarritz",
							"BIO" => "Bilbao",
							"BIL" => "Billings (MT)",
							"BLL" => "Billund",
							"BTU" => "Bintulu",
							"IRO" => "Biraro",
							"BHX" => "Birmingham [BHX]",
							"BHM" => "Birmingham (AL) [BHM]",
							"FRU" => "Bishkek (capital city)",
							"BIS" => "Bismarck (ND)",
							"BXO" => "Bissau (capital city)",
							"BCB" => "Blacksburg (VA)",
							"BLK" => "Blackpool",
							"BLT" => "Blackwater",
							"BLZ" => "Blantyre",
							"BHE" => "Blenheim",
							"BFN" => "Bloemfontein (judicial capital)",
							"BMI" => "Bloomington (IL)",
							"BMG" => "Bloomington (IN)",
							"BLF" => "Bluefield (WV)",
							"BYH" => "Blytheville (AR)",
							"BVB" => "Boa Vista [BVB]",
							"BVC" => "Boa Vista [BVC]",
							"BOY" => "Bobo Dioulasso",
							"BOO" => "Bodo",
							"BJV" => "Bodrum",
							"BOG" => "Bogota (capital city)",
							"BOI" => "Boise (ID)",
							"BKJ" => "Boke",
							"BLQ" => "Bologna",
							"BZO" => "Bolzano",
							"BOM" => "Bombay (Mumbai)",
							"BON" => "Bonaire",
							"YVB" => "Bonaventure",
							"BTE" => "Bonthe",
							"BOB" => "Bora Bora",
							"BOD" => "Bordeaux",
							"BXS" => "Borrego Springs (CA)",
							"BSA" => "Bosaso",
							"BOS" => "Boston (MA)",
							"BYK" => "Bouake",
							"BLD" => "Boulder City (NV)",
							"BOJ" => "Bourgas/Burgas",
							"BOH" => "Bournemouth",
							"ZBO" => "Bowen",
							"BZN" => "Bozeman (MT)",
							"BFD" => "Bradford/Warren (NY)",
							"BGZ" => "Braga",
							"BRD" => "Brainerd (MN)",
							"BMP" => "Brampton Island",
							"BSB" => "Brasilia (capital city)",
							"BTS" => "Bratislava (capital city)",
							"BZV" => "Brazzaville (capital city)",
							"BRE" => "Bremen",
							"VBS" => "Brescia",
							"BES" => "Brest",
							"BIV" => "Bria",
							"BDR" => "Bridgeport (CT)",
							"BGI" => "Bridgetown (capital city)",
							"BDS" => "Brindisi",
							"BNE" => "Brisbane",
							"BRS" => "Bristol",
							"BRQ" => "Brno",
							"BNN" => "Broennoeysund",
							"BHQ" => "Broken Hill",
							"BKX" => "Brookings (SD)",
							"BME" => "Broome",
							"BQK" => "Brunswick (GA)",
							"BRU" => "Brussels (capital city)",
							"BGA" => "Bucaramanga",
							"BUH" => "Bucharest (capital city)",
							"OTP" => "Bucharest",
							"BUD" => "Budapest (capital city)",
							"BUE" => "Buenos Aires (capital city)",
							"EZE" => "Buenos Aires [EZE]",
							"AEP" => "Buenos Aires [AEP]",
							"BFO" => "Buffalo Range",
							"BUF" => "Buffalo/Niagara Falls (NY)",
							"BJM" => "Bujumbura (capital city)",
							"BUQ" => "Bulawayo",
							"BDB" => "Bundaberg",
							"BUR" => "Burbank (CA)",
							"BRL" => "Burlington (IA)",
							"BTV" => "Burlington (VT)",
							"BWT" => "Burnie (Wynyard)",
							"BUZ" => "Bushehr",
							"BTM" => "Butte (MT)",
							"CAB" => "Cabinda",
							"CAG" => "Cagliari",
							"CNS" => "Cairns",
							"CAI" => "Cairo (capital city)",
							"CJC" => "Calama",
							"CCU" => "Calcutta (Kolkata)",
							"YYC" => "Calgary",
							"CLO" => "Cali",
							"CCJ" => "Calicut (Kozhikode)",
							"CLY" => "Calvi",
							"YCB" => "Cambridge Bay",
							"CBG" => "Cambrigde",
							"CAL" => "Campbeltown",
							"CGR" => "Campo Grande",
							"CBR" => "Canberra (capital city)",
							"CUN" => "Cancun",
							"CIW" => "Canouan (island)",
							"CPT" => "Cape Town",
							"CCS" => "Caracas (capital city)",
							"CWL" => "Cardiff",
							"CLD" => "Carlsbad (CA)",
							"CVQ" => "Carnarvon",
							"CRF" => "Carnot",
							"CSN" => "Carson City (NV)",
							"CTG" => "Cartagena",
							"LRM" => "La Romana",
							"CAS" => "Casablanca [CAS]",
							"CMN" => "Casablanca [CMN]",
							"CSI" => "Casino",
							"CPR" => "Casper (WY)",
							"(CRK)" => "Clark  ",
							"SLU" => "Castries (capital city)",
							"CTA" => "Catania",
							"CAY" => "Cayenne",
							"CDC" => "Cedar City (UT)",
							"CID" => "Cedar Rapids (IA)",
							"CED" => "Ceduna",
							"CES" => "Cessnock",
							"CMF" => "Chambery",
							"CMI" => "Champaign (IL)",
							"IXC" => "Chandigarh",
							"CGQ" => "Changchun",
							"CHQ" => "Chania",
							"CHG" => "Chaoyang",
							"CHS" => "Charleston (SC)",
							"CRW" => "Charleston (WV)",
							"CLT" => "Charlotte (NC)",
							"CHO" => "Charlottesville (VA)",
							"CXT" => "Charters Towers",
							"CHA" => "Chattanooga (TN)",
							"CTU" => "Chengdu",
							"MAA" => "Chennai (Madras)",
							"CYS" => "Cheyenne (WY)",
							"CNX" => "Chiang Mai",
							"CHI" => "Chicago (IL) [CHI]",
							"ORD" => "Chicago (IL) [ORD]",
							"MDW" => "Chicago (IL) [MDW]",
							"CZA" => "Chichen Itza",
							"CIC" => "Chico (CA)",
							"CUU" => "Chihuahua",
							"JKH" => "Chios Island",
							"CIP" => "Chipata",
							"KIV" => "Chisinau (capital city)",
							"HTA" => "Chita (Tschita)",
							"CTS" => "Sapporo",
							"CJL" => "Chitral",
							"CGP" => "Chittagong",
							"CKG" => "Chongqing",
							"CHC" => "Christchurch",
							"CCZ" => "Chub Cay",
							"YYQ" => "Churchill",
							"CFG" => "Cienfuegos",
							"CVG" => "Cincinnati (OH)",
							"CME" => "Ciudad Del Carmen",
							"CGU" => "Ciudad Guayana",
							"CJS" => "Ciudad Juarez",
							"CEN" => "Ciudad Obregon",
							"CVM" => "Ciudad Victoria",
							"CKB" => "Clarksburg (WV)",
							"CMQ" => "Clermont",
							"CFE" => "Clermont Ferrand",
							"CLE" => "Cleveland (OH) [CLE]",
							"BKL" => "Cleveland (OH) [BKL]",
							"CBB" => "Cochabamba",
							"COK" => "Cochin",
							"COD" => "Cody (WY)",
							"KCC" => "Coffmann Cove (AK)",
							"CFS" => "Coffs Harbour",
							"CJB" => "Coimbatore",
							"CLQ" => "Colima",
							"CLL" => "College Station/Bryan (TX)",
							"KCE" => "Collinsville",
							"CGN" => "Cologne",
							"CMB" => "Colombo (capital city)",
							"COS" => "Colorado Springs (CO)",
							"CAE" => "Columbia (SC)",
							"CSG" => "Columbus (GA)",
							"CMH" => "Columbus (OH)",
							"CKY" => "Conakry (capital city)",
							"CEP" => "Concepcion [CEP]",
							"CCP" => "Concepcion [CCP]",
							"CCR" => "Concord (CA)",
							"CON" => "Concord (NH)",
							"CZL" => "Constantine",
							"CND" => "Constanta (Constan?a)",
							"CPD" => "Coober Pedy",
							"CTN" => "Cooktown",
							"OOM" => "Cooma",
							"CPH" => "Copenhagen (capital city)",
							"COR" => "Cordoba [COR]",
							"ODB" => "Cordoba [ODB]",
							"CDV" => "Cordova (AK)",
							"CFU" => "Corfu (island)",
							"ORK" => "Cork",
							"CRP" => "Corpus Christi (TX)",
							"COO" => "Cotonou (capital city)",
							"CBU" => "Cottbus",
							"CVT" => "Coventry - Baginton",
							"CZM" => "Cozumel (island)",
							"CGA" => "Craig (AK)",
							"CEC" => "Crescent City (CA)",
							"CGB" => "Cuiaba",
							"CUL" => "Culiacan",
							"CUR" => "Willemstad, Curacao",
							"CWB" => "Curitiba",
							"CYU" => "Cuyo",
							"DKR" => "Dakar (capital city)",
							"DAK" => "Dakhla Oasis",
							"DLM" => "Dalaman",
							"DLI" => "Da Lat",
							"DBY" => "Dalby",
							"DLU" => "Dali",
							"DLC" => "Dalian",
							"DAL" => "Dallas (TX)",
							"DFW" => "Dallas/Ft. Worth (TX)",
							"DJO" => "Daloa",
							"DAM" => "Damascus (capital city)",
							"DMM" => "Dammam",
							"DAD" => "Da Nang",
							"DAN" => "Danville (VA)",
							"DCY" => "Daocheng",
							"DAR" => "Dar es Salam (Daressalam)",
							"DRW" => "Darwin",
							"DVO" => "Davao City",
							"DVN" => "Davenport (IA)",
							"DAV" => "David",
							"DAY" => "Dayton (OH)",
							"DAB" => "Daytona Beach (FL)",
							"DEC" => "Decatur (IL)",
							"YDF" => "Deer Lake/Corner Brook",
							"DED" => "Dehradun",
							"DRT" => "Del Rio (TX)",
							"DEL" => "Delhi (capital city)",
							"RTM" => "Den Haag (seat of government)",
							"DNZ" => "Denizli",
							"DPS" => "Denpasar",
							"DEN" => "Denver (CO)",
							"DSK" => "Dera Ismail Khan",
							"EMA" => "Derby [EMA]",
							"DRB" => "Derby [DRB]",
							"LDY" => "Derry (Londonderry)",
							"DSM" => "Des Moines (IA)",
							"DTT" => "Detroit (MI) [DTT]",
							"DTW" => "Detroit (MI) [DTW]",
							"DET" => "Detroit (MI) [DET]",
							"DVL" => "Devils Lake (ND)",
							"DPO" => "Devonport",
							"DHA" => "Dhahran",
							"DAC" => "Dhaka (capital city)",
							"DIN" => "Dien Bien Phu",
							"DIL" => "Dili (capital city)",
							"DLG" => "Dillingham (AK)",
							"DNR" => "Dinard",
							"DIR" => "Dire Dawa",
							"DIU" => "Diu",
							"DIY" => "Diyarbakir",
							"DJE" => "Djerba (island)",
							"JIB" => "Djibouti City (capital city)",
							"DOD" => "Dodoma (capital city)",
							"DOH" => "Doha (capital city)",
							"DSA" => "Doncaster/Sheffield",
							"CFN" => "Donegal (Carrickfin)",
							"DOK" => "Donetsk",
							"DGM" => "Dandugama (Colombo)",
							"DTM" => "Dortmund",
							"DHN" => "Dothan (AL)",
							"DLA" => "Douala",
							"DRS" => "Dresden",
							"DXB" => "Dubai",
							"DBO" => "Dubbo",
							"DUB" => "Dublin (capital city)",
							"DUJ" => "Dubois (PA)",
							"DBV" => "Dubrovnik",
							"DBQ" => "Dubuque (IA)",
							"DUS" => "Duesseldorf",
							"DLH" => "Duluth (WI)",
							"DUM" => "Dumai City",
							"DND" => "Dundee",
							"DUD" => "Dunedin",
							"DKI" => "Dunk Island",
							"DGO" => "Durango",
							"DRO" => "Durango (CO)",
							"DUR" => "Durban",
							"DYU" => "Dushanbe (capital city)",
							"DUT" => "Dutch Harbor (AK)",
							"DYA" => "Dysart",
							"DZA" => "Dzaoudzi",
							"ELS" => "East London",
							"IPC" => "Easter Island (Rapa Nui)",
							"EMA" => "East Midlands (region)",
							"EAU" => "Eau Clarie (WI)",
							"EDI" => "Edinburgh",
							"YEA" => "Edmonton [YEA]",
							"YEG" => "Edmonton [YEG]",
							"YXD" => "Edmonton [YXD]",
							"EGS" => "Egilsstadir",
							"EIN" => "Eindhoven",
							"ETH" => "Eilat [ETH]",
							"VDA" => "Eilat [VDA]",
							"EUN" => "El Aaiun (Laayoune)",
							"EBA" => "Elba (island)",
							"ELD" => "El Dorado (AR)",
							"EDL" => "Eldoret",
							"EKI" => "Elkhart (IN)",
							"EKO" => "Elko (NV)",
							"ELL" => "Ellisras",
							"EMY" => "El Minya",
							"ELM" => "Elmira (NY)",
							"ELP" => "El Paso (TX)",
							"ELY" => "Ely (NV)",
							"EDR" => "Edward River, Pormpuraaw",
							"EMD" => "Emerald",
							"ENF" => "Enontekioe",
							"EBB" => "Entebbe (Kampala)",
							"EBL" => "Erbil",
							"ERF" => "Erfurt",
							"ERI" => "Erie (PA)",
							"EVN" => "Erewan (Yerevan)",
							"ERC" => "Erzincan",
							"ERZ" => "Erzurum",
							"EBJ" => "Esbjerg",
							"ESC" => "Escanaba (MI)",
							"EPR" => "Esperance",
							"EUG" => "Eugene (OR)",
							"ACV" => "Eureka (CA)",
							"EVV" => "Evansville (IN)",
							"EVE" => "Evenes",
							"EXT" => "Exeter",
							"EZE" => "Ezeiza (Buenos Aires)",
							"FAI" => "Fairbanks (AK)",
							"FIE" => "Fair Isle (island)",
							"LYP" => "Faisalabad",
							"FAR" => "Fargo (ND)",
							"FMN" => "Farmington (NM)",
							"FAO" => "Faro",
							"FAE" => "Faroer (island)",
							"FYV" => "Fayetteville (AR)",
							"FAY" => "Fayetteville/Ft. Bragg (NC)",
							"FEZ" => "Fes",
							"FSC" => "Figari",
							"FLG" => "Flagstaff (AZ)",
							"YFO" => "Flin Flon",
							"FNT" => "Flint (MI)",
							"FLR" => "Florence (Firenze)",
							"FLO" => "Florence (SC)",
							"FLN" => "Florianopolis",
							"FRO" => "Floroe",
							"YFA" => "Fort Albany",
							"FDF" => "Fort de France (territorial capital)",
							"FOD" => "Fort Dodge (IA)",
							"FHU" => "Fort Huachuca/Sierra Vista (AZ)",
							"FLL" => "Fort Lauderdale (FL)",
							"YMM" => "Fort McMurray",
							"FMY" => "Fort Myers (FL) [FMY]",
							"RSW" => "Fort Myers (FL) [RSW]",
							"FRI" => "Fort Riley/Junction City (KS)",
							"YSM" => "Fort Smith [YSM]",
							"FSM" => "Fort Smith (AR) [FSM]",
							"YXJ" => "Fort St. John",
							"VPS" => "Fort Walton Beach (FL)",
							"FWA" => "Fort Wayne (IN)",
							"DFW" => "Fort Worth (TX)",
							"FOR" => "Fortaleza",
							"IGU" => "Foz do Iguacu",
							"FRW" => "Francistown",
							"FRA" => "Frankfurt/Main",
							"HHN" => "Frankfurt/Hahn",
							"FKL" => "Franklin/Oil City (PA)",
							"YFC" => "Fredericton",
							"FPO" => "Freeport",
							"FNA" => "Freetown (capital city)",
							"FRJ" => "Frejus",
							"FAT" => "Fresno (CA)",
							"FDH" => "Friedrichshafen",
							"FUE" => "Fuerteventura",
							"FJR" => "Fujairah",
							"FUK" => "Fukuoka",
							"FKS" => "Fukushima",
							"FNC" => "Funchal",
							"FUT" => "Futuna",
							"GBE" => "Gaborone (capital city)",
							"GAD" => "Gadsden (AL)",
							"GNV" => "Gainesville (FL)",
							"GWY" => "Galway",
							"YQX" => "Gander",
							"GOU" => "Garoua",
							"ELQ" => "Gassim (Al-Qassim)",
							"GZA" => "Gaza City",
							"GZT" => "Gaziantep",
							"GDN" => "Gdansk",
							"GEX" => "Geelong",
							"GVA" => "Geneva",
							"GOA" => "Genoa",
							"GRJ" => "George",
							"GEO" => "Georgetown (capital city)",
							"GET" => "Geraldton",
							"GRO" => "Gerona (Girona)",
							"GNE" => "Ghent (Gent)",
							"GIB" => "Gibraltar",
							"GCC" => "Gilette (WY)",
							"GIL" => "Gilgit",
							"YGX" => "Gillam",
							"GLT" => "Gladstone",
							"PIK" => "Glasgow [PIK]",
							"GLA" => "Glasgow [GLA]",
							"GGW" => "Glasgow (MT) [GGW]",
							"GDV" => "Glendive (MT)",
							"GOI" => "Goa",
							"GYN" => "Goiania",
							"OOL" => "Gold Coast, Coolangatta",
							"GOO" => "Goondiwindi",
							"YYR" => "Goose Bay",
							"GOZ" => "Gorna",
							"GOT" => "Gothenburg (G teborg)",
							"GOV" => "Gove/Nhulunbuy",
							"GHB" => "Govenors Harbour",
							"GRX" => "Granada",
							"TFS" => "Granadilla de Abona",
							"FPO" => "Grand Bahama at Freeport",
							"GCN" => "Grand Canyon, Tusayan (AZ)",
							"GCM" => "Grand Cayman",
							"GFK" => "Grand Forks (ND)",
							"GJT" => "Grand Junction (CO)",
							"GRR" => "Grand Rapids (MI)",
							"GPZ" => "Grand Rapids (MN)",
							"GRZ" => "Graz",
							"GTF" => "Great Falls (MT)",
							"GKL" => "Great Keppel Island",
							"GRB" => "Green Bay (WI)",
							"GSO" => "Greensboro (NC)",
							"GLH" => "Greenville (MS)",
							"PGV" => "Greenville (NC)",
							"GSP" => "Greenville/Spartanburg (SC)",
							"GND" => "St. George's (capital city)",
							"GNB" => "Grenoble",
							"GFF" => "Griffith",
							"GRQ" => "Groningen",
							"GTE" => "Groote Eylandt (island)",
							"GON" => "Groton/New London (CT)",
							"GDL" => "Guadalajara",
							"GUM" => "Guam",
							"CAN" => "Guangzhou",
							"GRU" => "Guarulhos, Sao Paulo",
							"GUA" => "Guatemala City (capital city)",
							"GYE" => "Guayaquil",
							"GCI" => "Guernsey",
							"GTI" => "Guettin",
							"KWL" => "Guilin",
							"GPT" => "Gulfport/Biloxi (MS)",
							"ULU" => "Gulu",
							"GUC" => "Gunnison (CO)",
							"GAU" => "Guwahati",
							"GWD" => "Gwadar",
							"GWE" => "Gweru",
							"GYP" => "Gympie",
							"HAC" => "Hachijo Jima",
							"GUM" => "Hagatna (capital)",
							"HFA" => "Haifa",
							"HNS" => "Haines (AK)",
							"HKD" => "Hakodate",
							"YHZ" => "Halifax",
							"YUX" => "Hall Beach",
							"HRI" => "Hambantota",
							"HAM" => "Hamburg",
							"HLT" => "Hamilton [HLT]",
							"YHM" => "Hamilton [YHM]",
							"HLZ" => "Hamilton [HLZ]",
							"HTI" => "Hamilton Island [HTI]",
							"HFT" => "Hammerfest",
							"CMX" => "Hancock (MI)",
							"HGH" => "Hangchow (Hangzhou)",
							"HAJ" => "Hannover",
							"HAN" => "Hanoi (capital city)",
							"HRE" => "Harare (capital city)",
							"HRB" => "Harbin (Haerbin)",
							"HRL" => "Harlingen/South Padre Island (TX)",
							"MDT" => "Harrisburg (PA) [MDT]",
							"HAR" => "Harrisburg (PA) [HAR]",
							"BDL" => "Hartford (CT)",
							"PIB" => "Hattiesburg/Laurel (MS)",
							"HDY" => "Hatyai (Hat Yai)",
							"HAU" => "Haugesund",
							"HAV" => "Havana (capital city)",
							"HVR" => "Havre (MT)",
							"HIS" => "Hayman Island",
							"HLN" => "Helena (MT)",
							"JHE" => "Helsingborg",
							"HEL" => "Helsinki (capital city)",
							"HEL" => "Helsinki [HEL]",
							"HEM" => "Helsinki [HEM]",
							"HER" => "Heraklion",
							"HMO" => "Hermosillo",
							"HVB" => "Hervey Bay",
							"HIB" => "Hibbing (MN)",
							"HKY" => "Hickory (NC)",
							"ITO" => "Hilo (HI)",
							"HHH" => "Hilton Head Island (SC)",
							"HNK" => "Hinchinbrook Island",
							"HIJ" => "Hiroshima",
							"SGN" => "Ho Chi Minh City (Saigon)",
							"HBA" => "Hobart",
							"HOQ" => "Hof",
							"HOG" => "Holguin",
							"HOM" => "Homer (AK)",
							"HKG" => "Hong Kong",
							"HIR" => "Honiara (capital city)",
							"HNL" => "Honolulu (HI)",
							"HNH" => "Hoonah (AK)",
							"HOR" => "Horta, Azores",
							"IAH" => "Houston (TX) [IAH]",
							"HOU" => "Houston (TX) [HOU]",
							"HUH" => "Huahine, Society Islands",
							"HUX" => "Huatulco",
							"HUI" => "Hue",
							"HUY" => "Humberside",
							"HTS" => "Huntington (WV)",
							"HSV" => "Huntsville (AL)",
							"HRG" => "Hurghada",
							"HON" => "Huron (SD)",
							"HWN" => "Hwange National Park",
							"HYA" => "Hyannis (MA)",
							"HYG" => "Hydaburg (AK)",
							"HYD" => "Hyderabad [HYD]",
							"HDD" => "Hyderabad [HDD]",
							"IAS" => "Iasi",
							"IBA" => "Ibadan",
							"IBE" => "Ibague",
							"IBZ" => "Ibiza (island)",
							"IDA" => "Idaho Falls (ID)",
							"IEJ" => "Iejima (island)",
							"IGR" => "Iguazu",
							"IJU" => "Ijui",
							"IOS" => "Ilheus",
							"ILP" => "Ile des Pins (island)",
							"IOU" => "Ile Ouen (island)",
							"ILI" => "Iliamna",
							"ILQ" => "Ilo",
							"ILR" => "Ilorin",
							"IMP" => "Imperatriz",
							"IPL" => "Imperial",
							"IMF" => "Imphal",
							"ICN" => "Incheon (Seoul)",
							"IDP" => "Independence",
							"IND" => "Indianapolis",
							"IGH" => "Ingham",
							"IGS" => "Ingolstadt",
							"INH" => "Inhambane",
							"IFL" => "Innisfail",
							"IDR" => "Indore",
							"INN" => "Innsbruck - Kranebitten",
							"INL" => "International Falls (MN)",
							"YEV" => "Inuvik",
							"IVC" => "Invercargill",
							"INV" => "Inverness",
							"IYK" => "Inyokern",
							"IOA" => "Ioannina",
							"IOW" => "Iowa City",
							"IPN" => "Ipatinga",
							"IPI" => "Ipiales",
							"IPH" => "Ipoh",
							"YFB" => "Iqaluit (Frobisher Bay)",
							"IQQ" => "Iquique",
							"IQT" => "Iquitos",
							"IRI" => "Iringa",
							"IKT" => "Irkutsk",
							"ISH" => "Ischia (island)",
							"IFN" => "Isfahan (Esfahan)",
							"ISG" => "Ishigaki",
							"IRP" => "Isiro",
							"ISB" => "Islamabad",
							"ILY" => "Islay",
							"IOM" => "Isle of Man",
							"ISP" => "Islip (Long Island)",
							"ISE" => "Isparta",
							"IST" => "Istanbul [IST]",
							"SAW" => "Istanbul [SAW]",
							"ITB" => "Itaituba",
							"ITM" => "Itami (near Osaka)",
							"ITH" => "Ithaca",
							"ITR" => "Itumbiara",
							"IVL" => "Ivalo",
							"IWO" => "Iwo Jima (Iwo To)",
							"ZIH" => "Ixtapa/Zihuatenejo",
							"IJK" => "Izhevsk",
							"ADB" => "Izmir",
							"IZO" => "Izumo",
							"JLR" => "Jabalpur",
							"JAB" => "Jabiru",
							"KPT" => "Jackpot (NV)",
							"JXN" => "Jackson (MI) [JXN]",
							"JAN" => "Jackson (MS) [JAN]",
							"HKS" => "Jackson (MS) [HKS]",
							"MKL" => "Jackson (TN) [MKL]",
							"JAC" => "Jackson (WY) [JAC]",
							"LRF" => "Jacksonville (AR) [LRF]",
							"JAX" => "Jacksonville (FL) [JAX]",
							"NZC" => "Jacksonville (FL) [NZC]",
							"NIP" => "Jacksonville (FL) [NIP]",
							"CRG" => "Jacksonville (FL) [CRG]",
							"IJX" => "Jacksonville (IL) [IJX]",
							"OAJ" => "Jacksonville (NC) [OAJ]",
							"JKV" => "Jacksonville (TX) [JKV]",
							"JAK" => "Jacmel",
							"JAG" => "Jacobabad",
							"JCM" => "Jacobina",
							"JAQ" => "Jacquinot Bay",
							"JAF" => "Jaffna",
							"JGB" => "Jagdalpur",
							"JAI" => "Jaipur",
							"JSA" => "Jaisalmer",
							"JKT" => "Jakarta (capital city)",
							"HLP" => "Jakarta",
							"CGK" => "Jakarta",
							"JAA" => "Jalalabad",
							"JAL" => "Jalapa",
							"JLS" => "Jales",
							"UIT" => "Jaluit Island (Jaluit Atoll)",
							"JMB" => "Jamba",
							"DJB" => "Jambi",
							"JAM" => "Jambol",
							"JMS" => "Jamestown (ND)",
							"JHW" => "Jamestown (NY)",
							"IXJ" => "Jammu",
							"JGA" => "Jamnagar",
							"IXW" => "Jamshedpur",
							"JKR" => "Janakpur",
							"JAD" => "Jandakot",
							"JVL" => "Janesville (WI)",
							"JNA" => "Januaria",
							"JQE" => "Jaque",
							"JTI" => "Jatai",
							"JAU" => "Jauja",
							"DJJ" => "Jayapura",
							"JED" => "Jeddah",
							"JEF" => "Jefferson City (MO)",
							"JEE" => "Jeremie",
							"XRY" => "Jerez de la Frontera/Cadiz",
							"JER" => "Jersey",
							"JRS" => "Jerusalem",
							"JSR" => "Jessore",
							"PYB" => "Jeypore",
							"JGS" => "Ji'an",
							"JMU" => "Jiamusi",
							"JGN" => "Jiayuguan",
							"GJL" => "Jijel",
							"JIJ" => "Jijiga",
							"JIL" => "Jilin City",
							"JIM" => "Jimma",
							"TNA" => "Jinan",
							"JDZ" => "Jingdezhen",
							"JHG" => "Jinghong",
							"JNG" => "Jining",
							"JIN" => "Jinja",
							"JJN" => "Jinjiang",
							"BCO" => "Jinka",
							"JNZ" => "Jinzhou",
							"JPR" => "Ji-Paran ",
							"JIP" => "Jipijapa",
							"JIR" => "Jiri",
							"JIU" => "Jiujiang",
							"JIW" => "Jiwani",
							"JCB" => "Joacaba",
							"JXA" => "Jixi",
							"JPA" => "Joao Pessoa",
							"JDH" => "Jodhpur",
							"JKG" => "Jonkoping (Joenkoeping)",
							"JOE" => "Joensuu",
							"JNB" => "Johannesburg",
							"BGM" => "Johnson City/Binghamton (NY)",
							"JON" => "Johnston Island",
							"JST" => "Johnstown (PA)",
							"JHB" => "Johor Bahru",
							"JOI" => "Joinville",
							"JOT" => "Joliet (IL)",
							"JOL" => "Jolo",
							"JMO" => "Jomsom",
							"JBR" => "Jonesboro (AR)",
							"JLN" => "Joplin (MO)",
							"JRH" => "Jorhat",
							"JOS" => "Jos",
							"JSM" => "Jose De San Martin",
							"AJF" => "Jouf (Al-Jouf)",
							"JJI" => "Juanjui",
							"JUB" => "Juba (capital city)",
							"JUI" => "Juist (island)",
							"JDF" => "Juiz De Fora",
							"JUJ" => "Jujuy",
							"JCK" => "Julia Creek",
							"JUL" => "Juliaca",
							"JUM" => "Jumla",
							"JUN" => "Jundah",
							"JNU" => "Juneau (AK)",
							"JNI" => "Junin",
							"JRN" => "Juruena",
							"JUT" => "Juticalpa",
							"JWA" => "Jwaneng",
							"JYV" => "Jyvaskyla",
							"KBL" => "Kabul (capital city)",
							"KOJ" => "Kagoshima",
							"KCM" => "Kahramanmaras",
							"OGG" => "Kahului (HI)",
							"KAJ" => "Kajaani",
							"KLX" => "Kalamata",
							"AZO" => "Kalamazoo/Battle Creek (MI)",
							"KGI" => "Kalgoorlie",
							"KLO" => "Kalibo",
							"FCA" => "Kalispell (MT)",
							"KLR" => "Kalmar",
							"YKA" => "Kamloops (BC)",
							"EBB" => "Kampala (capital city)",
							"MUE" => "Kamuela (HI)",
							"KDH" => "Kandahar",
							"KAN" => "Kano",
							"KNU" => "Kanpur",
							"MCI" => "Kansas City (MO)",
							"KHH" => "Kaohsiung",
							"JHM" => "Kapalua, Lahaina (HI)",
							"KHI" => "Karachi",
							"FKB" => "Karlsruhe/Baden-Baden",
							"KSD" => "Karlstad",
							"AOK" => "Karpathos (island)",
							"KTA" => "Karratha",
							"KUN" => "Kaunas",
							"KYS" => "Kayes",
							"KRB" => "Karumba",
							"KRP" => "Karup",
							"ZKE" => "Kashechewan",
							"KSL" => "Kassala",
							"KTR" => "Katherine",
							"KTM" => "Kathmandu (capital city)",
							"MPA" => "Katima Mulilo/Mpacha",
							"KHJ" => "Kauhajoki",
							"MKK" => "Kaunakakai (HI)",
							"KVA" => "Kavalla",
							"ASR" => "Kayseri (province)",
							"KZN" => "Kazan (Ka San)",
							"KMP" => "Keetmanshoop",
							"KEF" => "Keflavik (Reykjavik)",
							"YLW" => "Kelowna",
							"KEM" => "Kemi/Tornio",
							"ENA" => "Kenai (AK)",
							"MSE" => "Kent/Manston",
							"KIR" => "Kerry County",
							"KTN" => "Ketchikan (AK)",
							"EYW" => "Key West (FL)",
							"KHV" => "Khabarovsk",
							"AHB" => "Khamis Mushayat",
							"UVL" => "Kharga (Kharga Oasis)",
							"HRK" => "Kharkov (Kharkiv)",
							"KRT" => "Khartoum (capital city)",
							"KDD" => "Khuzdar",
							"KEL" => "Kiel",
							"KBP" => "Kiev (capital city)",
							"IEV" => "Kiev",
							"KGL" => "Kigali (capital city)",
							"JRO" => "Kilimanjaro",
							"ILE" => "Killeem (TX)",
							"KIM" => "Kimberley",
							"KNS" => "King Island",
							"AKN" => "King Salomon (AK)",
							"KGC" => "Kingscote",
							"KIN" => "Kingston (capital city)",
							"ISO" => "Kingston (NC)",
							"SVD" => "Kingstown (capital city)",
							"FIH" => "Kinshasa (capital city)",
							"CXI" => "Kiritimati (island)",
							"KKN" => "Kirkenes",
							"KIK" => "Kirkuk",
							"KRN" => "Kiruna",
							"KOI" => "Kirkwall (Orkney Islands)",
							"FKI" => "Kisangani",
							"KIH" => "Kish Island",
							"KKJ" => "Kitakyushu",
							"KTT" => "Kittil ",
							"KIW" => "Kitwe",
							"KLU" => "Klagenfurt",
							"LMT" => "Klamath Fall (OR)",
							"KLW" => "Klawock (AK)",
							"KLZ" => "Kleinsee (Kleinzee)",
							"NOC" => "Knock",
							"TYS" => "Knoxville (TN)",
							"UKB" => "Kobe",
							"KCZ" => "Kochi",
							"CGN" => "Koln (Cologne)",
							"ADQ" => "Kodiak (AK)",
							"OHT" => "Kohat",
							"KOK" => "Kokkola/Pietarsaari",
							"CCU" => "Kolkata (Calcutta)",
							"KMQ" => "Komatsu",
							"KOA" => "Kona (HI)",
							"KYA" => "Konya",
							"HGO" => "Korhogo",
							"KGS" => "Kos (island)",
							"KSA" => "Kosrae",
							"BKI" => "Kota Kinabalu",
							"OTZ" => "Kotzbue (AK)",
							"KWM" => "Kowanyama",
							"CCJ" => "Kozhikode (Calicut)",
							"KRK" => "Krakow (Cracow)",
							"KJA" => "Krasnoyarsk",
							"KRS" => "Kristiansand [KRS]",
							"KID" => "Kristianstad [KID]",
							"KSU" => "Kristiansund [KSU]",
							"KUL" => "Kuala Lumpur (capital city) [KUL]",
							"SZB" => "Kuala Lumpur [SZB]",
							"KNO" => "Kuala Namu (Medan)",
							"KUA" => "Kuantan",
							"KCH" => "Kuching",
							"KMJ" => "Kumamoto",
							"KMG" => "Kunming",
							"KNX" => "Kununurra",
							"KUO" => "Kuopio",
							"KUH" => "Kushiro",
							"YVP" => "Kuujjuaq (Fort Chimo)",
							"YGW" => "Kuujjuarapik",
							"KAO" => "Kuusamo",
							"KWI" => "Kuwait City",
							"LEK" => "Labe",
							"LBU" => "Labuan",
							"XLB" => "Lac Brochet (MB)",
							"LSE" => "La Crosse (WI)",
							"LAE" => "Lae",
							"LRH" => "La Rochelle",
							"LAF" => "Lafayette (IN)",
							"LFT" => "Lafayette (LA)",
							"LOS" => "Lagos",
							"LHE" => "Lahore",
							"SOB" => "Lake Balaton",
							"LCH" => "Lake Charles (LA)",
							"HII" => "Lake Havasu City, (AZ)",
							"TVL" => "Lake Tahoe (CA)",
							"LKL" => "Lakselv",
							"LBQ" => "Lambarene",
							"SUF" => "Lamezia Terme",
							"LMP" => "Lampedusa (island)",
							"LNY" => "Lanai City (HI)",
							"LNS" => "Lancaster (PA)",
							"LEQ" => "Land's End",
							"LGK" => "Langkawi (islands)",
							"LAI" => "Lannion",
							"HLA" => "Lanseria",
							"LAN" => "Lansing (MI)",
							"LPB" => "La Paz (capital city)",
							"LAP" => "La Paz",
							"LPP" => "Lappeenranta",
							"LAR" => "Laramie (WY)",
							"LRD" => "Laredo (TX)",
							"LCA" => "Larnaca",
							"LPA" => "Las Palmas",
							"LAS" => "Las Vegas (NV)",
							"LBE" => "Latrobe (near Pittsburgh) (PA)",
							"LST" => "Launceston",
							"LVO" => "Laverton",
							"LAW" => "Lawton (OK)",
							"LZC" => "Lazaro Cardenas",
							"YLR" => "Leaf Rapids",
							"LEA" => "Learmouth (Exmouth)",
							"LEB" => "Lebanon (NH)",
							"LBA" => "Leeds/Bradford",
							"EMA" => "Leicester",
							"LER" => "Leinster",
							"LEJ" => "Leipzig",
							"LEY" => "Lelystad",
							"BJX" => "Leon",
							"LNO" => "Leonora",
							"LWK" => "Lerwick/Tingwall (Shetland Islands)",
							"LWB" => "Lewisburg (WV)",
							"LWS" => "Lewiston (ID)",
							"LWT" => "Lewistown (MT)",
							"LEX" => "Lexington (KY)",
							"LXA" => "Lhasa",
							"LBV" => "Libreville (capital city)",
							"LDK" => "Lidkoeping",
							"LGG" => "Liege",
							"LIF" => "Lifou",
							"LIH" => "Lihue (HI)",
							"LIL" => "Lille",
							"LLW" => "Lilongwe (capital city)",
							"LIM" => "Lima (capital city)",
							"LIG" => "Limoges",
							"LNK" => "Lincoln (NE)",
							"LDC" => "Lindeman Island",
							"LNZ" => "Linz",
							"LIQ" => "Lisala",
							"LIS" => "Lisbon (capital city)",
							"LSY" => "Lismore",
							"LIT" => "Little Rock (AR)",
							"LPL" => "Liverpool",
							"LZR" => "Lizard Island",
							"LJU" => "Ljubljana (capital city)",
							"MTS" => "Lobamba/Manzini",
							"IRG" => "Lockhart River",
							"LFW" => "Lome (capital city)",
							"YXU" => "London [YXU]",
							"LON" => "London (capital city) [LON]",
							"LCY" => "London [LCY]",
							"LGW" => "London [LGW]",
							"LHR" => "London [LHR]",
							"LTN" => "London [LTN]",
							"STN" => "London [STN]",
							"SEN" => "London [SEN]",
							"LDY" => "Londonderry, Derry, Eglinton [LDY]",
							"LGB" => "Long Beach (CA)",
							"ISP" => "Long Island, Islip (NY)",
							"LRE" => "Longreach",
							"GGG" => "Longview/Kilgore (TX)",
							"LYR" => "Longyearbyen",
							"LTO" => "Loreto",
							"LRT" => "Lorient",
							"LAX" => "Los Angeles (CA)",
							"SJD" => "Los Cabos",
							"LMM" => "Los Mochis",
							"TFN" => "Los Rodeos",
							"LSZ" => "Losinj (island)",
							"LDE" => "Lourdes/Tarbes",
							"SDF" => "Louisville (KY)",
							"LAD" => "Luanda (capital city)",
							"LBB" => "Lubbock (TX)",
							"LKO" => "Lucknow",
							"LUD" => "Luederitz",
							"MLA" => "Luqa",
							"LUG" => "Lugano",
							"LLA" => "Lulea",
							"FBM" => "Lumbumbashi",
							"LUN" => "Lusaka (capital city)",
							"LUX" => "Luxembourg City (capital city)",
							"LUM" => "Luxi (Mangshi)",
							"LXR" => "Luxor",
							"LWO" => "Lviv (Lvov/Lemberg)",
							"LYX" => "Lydd",
							"LYH" => "Lynchburg (VA)",
							"LYN" => "Lyon",
							"LYS" => "Lyon",
							"MST" => "Maastricht/Aachen",
							"MEA" => "Macae",
							"MCP" => "Macapa",
							"MFM" => "Macau",
							"MCZ" => "Maceio",
							"MKY" => "Mackay",
							"MCN" => "Macon (GA)",
							"CEB" => "Mactan Island (Cebu)",
							"MED" => "Madinah",
							"MSN" => "Madison (WI)",
							"MAA" => "Madras (Chennai)",
							"MAD" => "Madrid (capital city)",
							"GDX" => "Magadan",
							"SEZ" => "Mahe",
							"MAH" => "Mahon",
							"MTL" => "Maitland",
							"MJN" => "Mahajanga (Majunga)",
							"MAJ" => "Majuro (capital city)",
							"UPG" => "Makassar",
							"MZG" => "Makung (Magong)",
							"SSG" => "Malabo",
							"AGP" => "Malaga",
							"MLX" => "Malatya",
							"MLE" => "Male",
							"MYD" => "Malindi",
							"MMA" => "Malmo (Malmoe) [MMA]",
							"MMX" => "Malmo (Malmoe) [MMX]",
							"MJC" => "Man",
							"MGA" => "Managua (capital city)",
							"BAH" => "Manama (capital city)",
							"MAO" => "Manaus",
							"MAN" => "Manchester",
							"MHT" => "Manchester (NH)",
							"MDL" => "Mandalay",
							"LUM" => "Mangshi (Luxi)",
							"MFO" => "Manguna",
							"XMH" => "Manihi (island)",
							"MNL" => "Manila (capital city)",
							"MSE" => "Manston/Kent",
							"ZLO" => "Manzanillo",
							"NZH" => "Manzhouli",
							"MTS" => "Manzini",
							"MPM" => "Maputo (capital city)",
							"MAB" => "Maraba",
							"MAR" => "Maracaibo",
							"MFQ" => "Maradi",
							"MTH" => "Marathon (FL)",
							"MDQ" => "Mar del Plata",
							"MQM" => "Mardin",
							"MEE" => "Mare",
							"MGH" => "Margate",
							"PMV" => "Margarita (island)",
							"MBX" => "Maribor",
							"MHQ" => "Mariehamn (Maarianhamina)",
							"MVR" => "Maroua",
							"MQT" => "Marquette (MI)",
							"RAK" => "Marrakesh",
							"RMF" => "Marsa Alam",
							"MUH" => "Marsa Matrah (Marsa Matruh)",
							"MRS" => "Marseille",
							"MHH" => "Marsh Harbour",
							"MVY" => "Martha's Vineyard (island) (MA)",
							"MRB" => "Martinsburg (WV)",
							"MBH" => "Maryborough",
							"MSU" => "Maseru (capital city)",
							"MCW" => "Mason City (IA)",
							"MVZ" => "Masvingo",
							"MMJ" => "Matsumoto/ Nagano",
							"MYJ" => "Matsuyama",
							"MTO" => "Mattoon (IL)",
							"MUB" => "Maun",
							"MAU" => "Maupiti (island)",
							"MRU" => "Mauritius (island)",
							"MAZ" => "Mayaguez",
							"MZT" => "Mazatlan",
							"MTS" => "Mbabane (capital city)",
							"MFE" => "McAllen (TX)",
							"QCA" => "Mecca",
							"KNO" => "Medan [KNO]",
							"MES" => "Medan [MES]",
							"MDE" => "Medellin",
							"MFR" => "Medford (OR)",
							"MED" => "Medina (Al-Madinah)",
							"MKR" => "Meekatharra",
							"MEL" => "Melbourne [MEL]",
							"MLB" => "Melbourne (FL) [MLB]",
							"FMM" => "Memmingen",
							"MEM" => "Memphis (TN)",
							"MDZ" => "Mendoza",
							"MDC" => "Manado",
							"MKQ" => "Merauke",
							"MCE" => "Merced (CA)",
							"MID" => "Merida",
							"MEI" => "Meridian (MS)",
							"MIM" => "Merimbula",
							"MEZ" => "Messina",
							"MTM" => "Metlakatla (AK)",
							"MZM" => "Metz",
							"ETZ" => "Metz",
							"MXL" => "Mexicali",
							"MEX" => "Mexico City (capital city)",
							"AZP" => "Mexico City [AZP]",
							"NLU" => "Mexico City [NLU]",
							"MFU" => "Mfuwe",
							"MIA" => "Miami (FL)",
							"MWD" => "Mianwali",
							"MMM" => "Middlemount",
							"MAF" => "Midland/Odessa (TX)",
							"MDY" => "Midway Island",
							"MIK" => "Mikkeli",
							"MIL" => "Milan [MIL]",
							"LIN" => "Milan [LIN]",
							"MXP" => "Milan [MXP]",
							"BGY" => "Milan [BGY]",
							"MQL" => "Mildura",
							"MLS" => "Miles City (MT)",
							"MFN" => "Milford Sound",
							"MKE" => "Milwaukee (WI)",
							"MTT" => "Minatitlan",
							"MRV" => "Mineralnye Vody",
							"MSP" => "Minneapolis (MN)",
							"MOT" => "Minot (ND)",
							"MSQ" => "Minsk (capital city)",
							"MYY" => "Miri",
							"MSO" => "Missula (MT)",
							"MHE" => "Mitchell (SD)",
							"MMY" => "Miyako Jima (Ryuku Islands)",
							"KMI" => "Miyazaki",
							"MBM" => "Mkambati",
							"MFF" => "Moanda",
							"MOB" => "Mobile (AL)",
							"MOD" => "Modesto (CA)",
							"MJD" => "Moenjodaro",
							"MGQ" => "Mogadishu (capital city)",
							"OKU" => "Mokuti Lodge",
							"MLI" => "Moline/Quad Cities (IL)",
							"MBA" => "Mombasa",
							"MCM" => "Monaco",
							"MIR" => "Monastir",
							"YQM" => "Moncton",
							"MLU" => "Monroe (LA)",
							"ROB" => "Monrovia (capital city)",
							"MLW" => "Monrovia",
							"MBJ" => "Montego Bay",
							"MRY" => "Monterey (CA)",
							"MTY" => "Monterrey",
							"NTR" => "Monterrey",
							"MOC" => "Montes Claros",
							"MVD" => "Montevideo (capital city)",
							"MGM" => "Montgomery (AL)",
							"MPL" => "Montpellier",
							"YMQ" => "Montreal [YMQ]",
							"YUL" => "Montreal [YUL]",
							"YMX" => "Montreal [YMZ]",
							"MTJ" => "Montrose/Tellruide (CO)",
							"MOZ" => "Moorea (Mo'orea island)",
							"MOV" => "Moranbah",
							"MRZ" => "Moree",
							"MLM" => "Morelia",
							"MGW" => "Morgantown (WV)",
							"HNA" => "Morioka",
							"HAH" => "Moroni (capital city) [HAH]",
							"YVA" => "Moroni [YVA]",
							"MYA" => "Moruya",
							"MOW" => "Moscow (capital city) [MOW]",
							"DME" => "Moscow [DME]",
							"SVO" => "Moscow [SVO]",
							"VKO" => "Moscow [VKO]",
							"MWH" => "Moses Lake (WA)",
							"RYG" => "Moss",
							"MZY" => "Mossel Bay",
							"OMO" => "Mostar",
							"OSM" => "Mosul",
							"MJL" => "Mouila",
							"MQQ" => "Moundou",
							"GTN" => "Mount Cook",
							"MGB" => "Mount Gambier",
							"MMG" => "Mount Magnet",
							"UTT" => "Mthatha (Umtata)",
							"ISA" => "Mt. Isa",
							"MCL" => "Mt. McKinley (AK)",
							"MDG" => "Mudanjiang",
							"MUC" => "Munchen (Munich)",
							"FMO" => "Muenster/Osnabrueck",
							"MLH" => "Mulhouse",
							"MUX" => "Multan",
							"BOM" => "Mumbai (Bombay)",
							"MJV" => "Murcia",
							"MMK" => "Murmansk",
							"MSR" => "Mus",
							"MCT" => "Muscat (capital city)",
							"MSL" => "Muscle Shoals (AL)",
							"MKG" => "Muskegon (MI)",
							"MFG" => "Muzaffarabad",
							"MVB" => "Mvengue",
							"JMK" => "Mykonos (island)",
							"MYR" => "Myrtle Beach (SC) [MYR]",
							"CRE" => "Myrtle Beach (SC) [CRE]",
							"MYQ" => "Mysore (Mysuru)",
							"MJT" => "Mytilene (Lesbos island)",
							"MZF" => "Mzamba",
							"NAN" => "Nadi",
							"NGS" => "Nagasaki",
							"NGO" => "Nagoya",
							"NAG" => "Nagpur",
							"OKA" => "Naha",
							"NBO" => "Nairobi (capital city)",
							"NAJ" => "Nakhchivan",
							"NAK" => "Nakhon Ratchasima",
							"NST" => "Nakhon Si Thammarat",
							"KHN" => "Nanchang",
							"ENC" => "Nancy",
							"YSR" => "Nanisivik",
							"NNG" => "Nanning",
							"NTE" => "Nantes",
							"ACK" => "Nantucket (MA)",
							"NAP" => "Naples (Napoli)",
							"APF" => "Naples (FL)",
							"NRT" => "Narita (Tokyo)",
							"NAA" => "Narrabri",
							"NRA" => "Narrandera",
							"UAK" => "Narsarsuaq",
							"BNA" => "Nashville (TN)",
							"NAS" => "Nassau (capital city)",
							"NAT" => "Natal",
							"SUV" => "Nausori/Suva",
							"WNS" => "Nawabshah",
							"JNX" => "Naxos (island)",
							"NYT" => "Naypyidaw (capital city)",
							"NDJ" => "N'Djamena (capital city)",
							"NLA" => "N'Dola (Ndola)",
							"NSN" => "Nelson",
							"NLP" => "Nelspruit [NLP]",
							"MQP" => "Nelspruit [MQP]",
							"NEV" => "Nevis",
							"EWN" => "New Bern (NC)",
							"HVN" => "New Haven (CT)",
							"MSY" => "New Orleans (LA)",
							"NQY" => "Newquay",
							"UVL" => "Kharga",
							"NYC" => "New York (NY) [NYC]",
							"JFK" => "New York (NY) [JFK]",
							"LGA" => "New York (NY) [LGA]",
							"EWR" => "New York (NJ) [EWR]",
							"SWF" => "Newburgh (NY)",
							"BEO" => "Newcastle [BEO]",
							"NTL" => "Newcastle [NTL]",
							"NCL" => "Newcastle [NCL]",
							"NCS" => "Newcastle [NCS]",
							"ZNE" => "Newman",
							"PHF" => "Newport News/Williamsburg (VA)",
							"NGE" => "N'Gaoundere",
							"ROR" => "Ngerulmud (capital city)",
							"IAG" => "Niagara Falls International",
							"NIM" => "Niamey (capital city)",
							"NCE" => "Nice",
							"NIC" => "Nicosia",
							"NLV" => "Nikolaev (Mykolaiv)",
							"KIJ" => "Niigata",
							"FNI" => "Nimes",
							"NGB" => "Ningbo",
							"INI" => "Nis",
							"OLS" => "Nogales (AZ)",
							"OME" => "Nome (AK)",
							"NLK" => "Norfolk Island",
							"ORF" => "Norfolk/Virginia Beach (VA)",
							"YVQ" => "Norman Wells",
							"NRK" => "Norrkoeping",
							"OTH" => "North Bend (OR)",
							"ELH" => "North Eleuthera",
							"NWI" => "Norwich",
							"EMA" => "Nottingham",
							"NDB" => "Nouadhibou",
							"NKC" => "Nouakchott (capital city)",
							"NOU" => "Noumea (administrative capital)",
							"GEA" => "Noumea",
							"QND" => "Novi Sad",
							"OVB" => "Novosibirsk",
							"NUE" => "Nurnberg (Nuremberg)",
							"NLD" => "Nuevo Laredo",
							"TBU" => "Nuku'alofa (capital city)",
							"GOH" => "Nuuk (capital city)",
							"OAK" => "Oakland (CA)",
							"OAX" => "Oaxaca de Ju rez",
							"ODE" => "Odense",
							"ODS" => "Odessa",
							"ORB" => "Orebro (Oerebro)",
							"OHD" => "Ohrid",
							"OIT" => "Oita",
							"OKJ" => "Okayama [OKJ]",
							"OKC" => "Oklahoma City (OK) [OKC]",
							"OLB" => "Olbia",
							"OLP" => "Olympic Dam",
							"OMA" => "Omaha (NE)",
							"OND" => "Ondangwa",
							"ONT" => "Ontario (CA)",
							"ORN" => "Oran (Ouahran)",
							"OAG" => "Orange",
							"SNA" => "Orange County (Santa Ana) (CA)",
							"OMD" => "Oranjemund",
							"AUA" => "Oranjestad",
							"KOI" => "Orkney (islands)",
							"ORL" => "Orlando (FL) [ORL]",
							"MCO" => "Orlando (FL) [MCO]",
							"ORS" => "Orpheus Island",
							"OSA" => "Osaka [OSA]",
							"ITM" => "Osaka [ITM]",
							"KIX" => "Osaka [KIX]",
							"OSH" => "Oshkosh (WI)",
							"OSI" => "Osijek",
							"OSL" => "Oslo (capital city) [OSL]",
							"FBU" => "Oslo [FBU]",
							"TRF" => "Oslo [TRF]",
							"YOW" => "Ottawa (capital city)",
							"ODA" => "Ouadda",
							"OZZ" => "Ouarzazate",
							"OUH" => "Oudtshoorn",
							"OUA" => "Ouagadougou (capital city)",
							"OUD" => "Oujda",
							"OUL" => "Oulu",
							"OUK" => "Out Skerries (Shetland)",
							"UVE" => "Ouvea",
							"OVD" => "Oviedo",
							"OWB" => "Owensboro (KY)",
							"OXR" => "Oxnard (CA)",
							"OYE" => "Oyem",
							"PAD" => "Paderborn/Lippstadt",
							"PDG" => "Padang",
							"PAH" => "Paducah (KY)",
							"PGA" => "Page/Lake Powell (AZ)",
							"PPG" => "Pago Pago (capital city)",
							"PYY" => "Pai",
							"PKB" => "Pakersburg (WV) /Marietta (OH)",
							"PLQ" => "Palanga",
							"PMO" => "Palermo",
							"PMI" => "Palma de Mallorca",
							"PMW" => "Palmas",
							"PMD" => "Palmdale/Lancaster (CA)",
							"PMR" => "Palmerston North",
							"PSP" => "Palm Springs (CA)",
							"PAO" => "Palo Alto (CA)",
							"PTY" => "Panama City (capital city)",
							"PFN" => "Panama City (FL)",
							"PJG" => "Panjgur",
							"PNL" => "Pantelleria",
							"PGH" => "Pantnagar",
							"PPT" => "Papeete (capital city)",
							"PFO" => "Paphos",
							"PBO" => "Paraburdoo",
							"PBM" => "Paramaribo (capital city)",
							"PAR" => "Paris (capital city) [PAR]",
							"CDG" => "Paris [CDG]",
							"LBG" => "Paris [LBG]",
							"ORY" => "Paris [ORY]",
							"BVA" => "Paris/Beauvais [BVA]",
							"PHB" => "Parnaiba",
							"PBH" => "Paro",
							"PGL" => "Pascagoula (MS)",
							"PSC" => "Pasco (WA)",
							"PSI" => "Pasni",
							"PAT" => "Patna",
							"PYX" => "Pattaya",
							"PUF" => "Pau",
							"PWQ" => "Pavlodar",
							"PDU" => "Paysandu",
							"PLN" => "Pellston (MI)",
							"PET" => "Pelotas",
							"PEN" => "Penang",
							"PDT" => "Pendelton (OR)",
							"PNS" => "Pensacola (FL)",
							"PIA" => "Peoria/Bloomington (IL)",
							"PEI" => "Pereira",
							"PGF" => "Perpignan",
							"PER" => "Perth",
							"PEG" => "Perugia",
							"PSR" => "Pescara",
							"PEW" => "Peshawar",
							"PSG" => "Petersburg (AK)",
							"PHW" => "Phalaborwa",
							"PHY" => "Phetchabun",
							"PHL" => "Philadelphia (PA)",
							"PNH" => "Phnom Penh (capital city)",
							"PHX" => "Phoenix (AZ) [PHX]",
							"DVT" => "Phoenix (AZ) [DVT]",
							"AZA" => "Phoenix (AZ) [AZA]",
							"HKT" => "Phuket (island)",
							"PDS" => "Piedras Negras",
							"PIR" => "Pierre (SD)",
							"PZB" => "Pietermaritzburg",
							"PTG" => "Pietersburg",
							"NTY" => "Pilanesberg/Sun City",
							"PSA" => "Pisa",
							"PIT" => "Pittsburgh (PA)",
							"PLB" => "Plattsburgh (NY)",
							"PBZ" => "Plettenberg Bay",
							"PDV" => "Plovdiv",
							"PIH" => "Pocatello (ID)",
							"TGD" => "Podgorica (capital city)",
							"PNI" => "Pohnpei, Kolonia",
							"PTP" => "Pointe a Pitre",
							"PNR" => "Pointe Noire",
							"PIS" => "Poitiers",
							"PTG" => "Polokwane (Pietersburg)",
							"PSE" => "Ponce",
							"PDL" => "Ponta Delgada",
							"PMG" => "Ponta Pora",
							"POR" => "Pori",
							"PMV" => "Porlamar, Isla Margarita",
							"CLM" => "Port Angeles (WA)",
							"PAP" => "Port au Prince (capital city)",
							"PUG" => "Port Augusta",
							"PLZ" => "Port Elizabeth",
							"POG" => "Port Gentil",
							"PHC" => "Port Harcourt",
							"PHE" => "Port Hedland",
							"PHN" => "Port Huron (MI)",
							"PTJ" => "Portland",
							"PWM" => "Portland (ME)",
							"PDX" => "Portland (OR)",
							"PLO" => "Port Lincoln",
							"PQQ" => "Port Macquarie",
							"YPN" => "Port Menier (PQ)",
							"POM" => "Port Moresby (capital city)",
							"OPO" => "Porto",
							"POA" => "Porto Alegre",
							"POS" => "Port of Spain (capital city)",
							"COO" => "Porto-Novo (capital city)",
							"PXO" => "Porto Santo",
							"PZU" => "Port Sudan",
							"PVH" => "Porto Velho",
							"PSD" => "Port Said",
							"PSM" => "Portsmouth (NH)",
							"VLI" => "Port Vila (capital city)",
							"POU" => "Poughkeepsie (NY)",
							"POZ" => "Poznan",
							"PRG" => "Prague (capital city)",
							"RAI" => "Praia (capital city)",
							"PQI" => "Presque Island (ME)",
							"PIK" => "Prestwick (near Glasgow)",
							"PRY" => "Pretoria (capital city)",
							"PVK" => "Preveza/Lefkas",
							"YXS" => "Prince George",
							"YPR" => "Prince Rupert/Digby Island",
							"PRN" => "Pristina",
							"PPP" => "Prosperpine",
							"PVD" => "Providence (RI)",
							"PLS" => "Providenciales",
							"SCC" => "Prudhoe Bay (AK)",
							"PCL" => "Pucallpa",
							"PBC" => "Puebla",
							"PUB" => "Pueblo (CO)",
							"PXM" => "Puerto Escondido",
							"PEM" => "Puerto Maldonado",
							"PZO" => "Puerto Ordaz",
							"POP" => "Puerto Plata",
							"PPS" => "Puerto Princesa",
							"PSZ" => "Puerto Suarez",
							"PVR" => "Puerto Vallarta",
							"XPK" => "Pukatawagan",
							"PUY" => "Pula",
							"PUW" => "Pullman (WA)",
							"PNQ" => "Pune (Poona)",
							"PUQ" => "Punta Arenas",
							"PUJ" => "Punta Cana",
							"PDP" => "Punta del Este",
							"PUS" => "Pusan (Busan)",
							"FNJ" => "Pyongyang (capital city)",
							"JQA" => "Qaarsut",
							"LQN" => "Qala i Naw (city)",
							"GSR" => "Qardho (Gardo)",
							"GZW" => "Qazvin",
							"JIQ" => "Qianjiang",
							"IQM" => "Qiemo",
							"YVM" => "Qikiqtarjuaq",
							"TAO" => "Qingdao",
							"XIC" => "Qingshan",
							"IQN" => "Qingyang",
							"BPE" => "Qinhuangdao [BPE]",
							"SHP" => "Qinhuangdao [SHP]",
							"IHN" => "Qishn",
							"UKT" => "Quakertown (PA)",
							"XQU" => "Qualicum Beach",
							"JJN" => "Quanzhou",
							"YQC" => "Quaqtaq",
							"YQB" => "Quebec City",
							"UEE" => "Queenstown [UEE]",
							"ZQN" => "Queenstown [ZQN]",
							"UEL" => "Quelimane",
							"XQP" => "Quepos",
							"QRO" => "Queretaro",
							"YQZ" => "Quesnel",
							"UET" => "Quetta",
							"AAZ" => "Quetzaltenango (Xelaj )",
							"UIB" => "Quibdo",
							"AQB" => "Quiche",
							"UIP" => "Quimper",
							"UIN" => "Quincy (IL)",
							"KWN" => "Quinhagak (AK)",
							"UIH" => "Qui Nhon",
							"UIO" => "Quito (capital city)",
							"UIQ" => "Quoin Hill",
							"JUZ" => "Quzhou",
							"RBA" => "Rabat",
							"RYK" => "Rahim Yar Khan",
							"RFP" => "Raiatea (island)",
							"YOP" => "Rainbow Lake",
							"RAJ" => "Rajkot",
							"RDU" => "Raleigh/Durham (NC)",
							"IXR" => "Ranchi",
							"RGI" => "Rangiroa (island)",
							"RGN" => "Rangoon (Yangon)",
							"RAP" => "Rapid City (SD)",
							"RAR" => "Rarotonga (island)",
							"RKT" => "Ras al Khaymah (Ras al Khaimah)",
							"RAZ" => "Rawala Kot",
							"ISB" => "Rawalpindi",
							"UTP" => "Rayong",
							"RDG" => "Reading (PA)",
							"REC" => "Recife",
							"RDD" => "Redding (CA)",
							"RDM" => "Redmond (OR)",
							"REG" => "Reggio Calabria",
							"YQR" => "Regina",
							"RNS" => "Rennes",
							"RNO" => "Reno (NV)",
							"RES" => "Resistencia",
							"YRB" => "Resolute Bay",
							"REU" => "Reus",
							"REK" => "Reykjavik (capital city) [REK]",
							"RKV" => "Reykjavik [RKV]",
							"KEF" => "Reykjavik [KEF]",
							"REX" => "Reynosa",
							"RHI" => "Rhinelander (WI)",
							"RHO" => "Rhodes (island)",
							"RCB" => "Richards Bay",
							"RIC" => "Richmond (VA)",
							"RIX" => "Riga (capital city)",
							"RJK" => "Rijeka",
							"RMI" => "Rimini",
							"RBR" => "Rio Branco",
							"RIO" => "Rio de Janeiro [RIO]",
							"GIG" => "Rio de Janeiro [GIG]",
							"SDU" => "Rio de Janeiro [SDU]",
							"RGL" => "Rio Gallegos",
							"RGA" => "R o Grande [RGA]",
							"RIG" => "Rio Grande [RIG]",
							"RVY" => "Rivera",
							"RUH" => "Riyadh (capital city)",
							"RNE" => "Roanne",
							"ROA" => "Roanoke (VA)",
							"RZZ" => "Roanoke Rapids (NC)",
							"RTB" => "Roatan",
							"RST" => "Rochester (MN) [RST]",
							"ROC" => "Rochester (NY) [ROC]",
							"RSD" => "Rock Sound",
							"RKS" => "Rock Springs (WY)",
							"RFD" => "Rockford (IL)",
							"ROK" => "Rockhampton",
							"RKD" => "Rockland (ME)",
							"RWI" => "Rocky Mount - Wilson (NC)",
							"RDZ" => "Rodez",
							"RRG" => "Rodrigues Island",
							"RNN" => "Roenne (Ronne) Bornholm is.",
							"ROM" => "Rome (capital city)",
							"CIA" => "Rome [CIA]",
							"FCO" => "Rome [FCO]",
							"RME" => "Rome (NY) Oneida County",
							"RNB" => "Ronneby",
							"ROS" => "Rosario",
							"DCF" => "Roseau (capital city)",
							"DOM" => "Roseau",
							"RPN" => "Rosh Pina",
							"ROW" => "Roswell (NM)",
							"ROT" => "Rotorua",
							"RTM" => "Rotterdam",
							"RVN" => "Rovaniemi",
							"NDU" => "Rundu",
							"ROU" => "Ruse",
							"RZN" => "Ryazan",
							"SCN" => "Saarbruecken",
							"SMF" => "Sacramento (CA)",
							"SDS" => "Sado Shima (island)",
							"MBS" => "Saginaw/Bay City/Midland (MI)",
							"SDT" => "Saidu Sharif",
							"SGN" => "Saigon (Ho Chi Minh City)",
							"SBK" => "Saint Brieuc",
							"SKV" => "Saint Catherine",
							"RUN" => "Saint Denis (administrative capital)",
							"YSJ" => "Saint John",
							"STL" => "Saint Louis (MO) [TL]",
							"SUS" => "Saint Louis (MO)",
							"MSP" => "Saint Paul (MN)",
							"SPN" => "Saipan",
							"SID" => "Sal",
							"SLL" => "Salalah",
							"SLE" => "Salem (OR)",
							"SNS" => "Salinas (CA) [SNS]",
							"SNC" => "Salinas [SNC]",
							"SBY" => "Salisbury (MD)",
							"SKG" => "Saloniki (Thessaloniki)",
							"SLC" => "Salt Lake City (UT)",
							"STY" => "Salto",
							"SSA" => "Salvador",
							"SZG" => "Salzburg",
							"AZS" => "Samana",
							"SKD" => "Samarkand",
							"SMI" => "Samos (island)",
							"SZF" => "Samsun",
							"ADZ" => "San Andres (island)",
							"SJT" => "San Angelo (TX)",
							"SAT" => "San Antonio (TX) [SAT]",
							"BRC" => "San Carlos de Bariloche",
							"SCY" => "San Crist bal Island",
							"SBT" => "San Bernardino (CA)",
							"SDK" => "Sandakan",
							"SDN" => "Sandane",
							"SAN" => "San Diego (CA)",
							"SFH" => "San Felipe",
							"SFB" => "Sanford (FL)",
							"SFO" => "San Francisco (CA)",
							"SJD" => "San Jose Cabo [SJD]",
							"SJO" => "San Jose (capital city) [SJO]",
							"SYQ" => "San Jose [SYQ]",
							"SJC" => "San Jose (CA) [SJC]",
							"SJI" => "San Jose [SJI]",
							"SJE" => "San Jose del Guaviare [SJE]",
							"SJU" => "San Juan (capital city)",
							"SIG" => "San Juan, Miramar",
							"SBP" => "San Luis Obisco (CA)",
							"SLP" => "San Luis Potosi",
							"SPR" => "San Pedro [SPR]",
							"SPY" => "San Pedro [SPY]",
							"SAP" => "San Pedro Sula",
							"ZSA" => "San Salvador",
							"SAL" => "San Salvador (capital city)",
							"EAS" => "San Sebastian",
							"SAH" => "Sanaa (capital city)",
							"YZP" => "Sandspit",
							"SNA" => "Santa Ana (CA)",
							"SBA" => "Santa Barbara (CA) [SBA]",
							"SZN" => "Santa Barbara (CA) [SZN]",
							"SNU" => "Santa Clara",
							"SPC" => "Santa Cruz de la Palma",
							"SRZ" => "Santa Cruz de la Sierra",
							"SAF" => "Santa Fe (NM)",
							"SMA" => "Santa Maria (island)",
							"SMX" => "Santa Maria (CA)",
							"SMR" => "Santa Marta",
							"SDR" => "Santander",
							"STM" => "Santarem",
							"STS" => "Santa Rosa (CA) [STS]",
							"RSA" => "Santa Rosa [RSA]",
							"SRB" => "Santa Rosa [SRB]",
							"SRA" => "Santa Rosa [SRA]",
							"SDH" => "Santa Rosa de Copan",
							"SSL" => "Santa Rosalia [SSL]",
							"SRL" => "Santa Rosalia [SRL]",
							"SCU" => "Santiago",
							"SCL" => "Santiago de Chile (capital city)",
							"SCQ" => "Santiago de Compostela",
							"SDE" => "Santiago del Estero",
							"STI" => "Santiago de los Caballeros",
							"RAI" => "Santiago Island",
							"SON" => "Santo",
							"SDQ" => "Santo Domingo (capital city)",
							"SYX" => "Sanya",
							"SLZ" => "Sao Luis",
							"SAO" => "Sao Paulo [SAO]",
							"CGH" => "Sao Paulo [CGH]",
							"GRU" => "Sao Paulo [GRU]",
							"VCP" => "Sao Paulo [VCP]",
							"TMS" => "Sao Tome (capital city)",
							"SPK" => "Sapporo [SPK]",
							"OKD" => "Sapporo [OKD]",
							"CTS" => "Sapporo [CTS]",
							"SJJ" => "Sarajevo (capital city)",
							"SRQ" => "Sarasota/Bradenton (FL)",
							"YXE" => "Saskatoon",
							"ZSS" => "Sassandra",
							"SUJ" => "Satu Mare",
							"SAV" => "Savannah (GA)",
							"SVL" => "Savonlinna",
							"SAU" => "Savu Island",
							"TAB" => "Scarborough",
							"NSO" => "Scone",
							"SCF" => "Scottsdale (AZ)",
							"SEA" => "Seattle (WA) [SEA]",
							"LKE" => "Seattle (WA) [LKE]",
							"BFI" => "Seattle (WA) [BFI]",
							"SDX" => "Sedona (AZ)",
							"SEB" => "Sehba",
							"SJY" => "Seinaejoki",
							"PKW" => "Selebi-Phikwe",
							"SRG" => "Semarang",
							"SDJ" => "Sendai",
							"SEL" => "Seoul (capital city)",
							"ICN" => "Seoul [ICN]",
							"SEL" => "Seoul [SEL]",
							"SYD" => "Australia, Sydney Kingsford Smith Arpt [SYD]",
							"TCP" => "Taba",
							"TBJ" => "Tabarka",
							"TBT" => "Tabatinga",
							"TBZ" => "Tabriz",
							"TUU" => "Tabuk",
							"THL" => "Tachilek",
							"TAC" => "Tacloban City",
							"TIW" => "Tacoma (WA)",
							"TAG" => "Tagbilaran",
							"TIF" => "Taif (Ta'if)",
							"TNN" => "Tainan City",
							"TPE" => "Taipei (capital city)",
							"TPE" => "Taipei [TPE]",
							"TSA" => "Taipei [TSA]",
							"TYN" => "Taiyuan",
							"TAK" => "Takamatsu",
							"TYL" => "Talara",
							"TKA" => "Talkeetna (AK)",
							"TLH" => "Tallahassee (FL)",
							"TLL" => "Tallinn (capital city)",
							"TML" => "Tamale",
							"TMR" => "Tamanrasset",
							"TNO" => "Tamarindo",
							"TPA" => "Tampa (FL)",
							"TMP" => "Tampere",
							"TAM" => "Tampico",
							"TMW" => "Tamworth",
							"TNG" => "Tangier",
							"TNJ" => "Tanjung Pinang",
							"TRW" => "Tarawa (capital city)",
							"TRO" => "Taree",
							"TGV" => "Targovishte",
							"TGM" => "Targu-Mures",
							"TAY" => "Tartu",
							"TAS" => "Tashkent (capital city)",
							"TRG" => "Tauranga",
							"TWU" => "Tawau",
							"TBS" => "Tbilisi (capital city)",
							"TEU" => "Te Anau",
							"MME" => "Teesside",
							"TGU" => "Tegucigalpa (capital city)",
							"IKA" => "Tehran (capital city)",
							"THR" => "Tehran",
							"TCN" => "Tehuacan",
							"TEQ" => "Tekirdag",
							"TLV" => "Tel Aviv [TLV]",
							"SDV" => "Tel Aviv [SDV]",
							"TEX" => "Telluride (CO)",
							"TEM" => "Temora",
							"ZCO" => "Temuco",
							"TCI" => "Tenerife (island) [TCI]",
							"TFN" => "Tenerife [TFN]",
							"TFS" => "Tenerife [TFS]",
							"TCZ" => "Tengchong",
							"TCA" => "Tennant Creek",
							"TPQ" => "Tepic",
							"TER" => "Terceira (island)",
							"THE" => "Teresina",
							"TMZ" => "Termez (Termes)",
							"TNL" => "Ternopil",
							"YXT" => "Terrace",
							"HUF" => "Terre Haute (IN)",
							"TEB" => "Teterboro (NJ)",
							"TTU" => "Tetouan (Tetouan)",
							"TXK" => "Texarkana (AR)",
							"TEZ" => "Tezpur",
							"TEI" => "Tezu",
							"TCU" => "Thaba'Nchu",
							"YQD" => "The Pas",
							"SKG" => "Thessaloniki",
							"TVF" => "Thief River Falls (MN)",
							"PBH" => "Thimphu (capital city)",
							"JTR" => "Thira (island)",
							"TRV" => "Thiruvananthapuram",
							"TED" => "Thisted",
							"YTH" => "Thompson",
							"KTB" => "Thorne Bay (AK)",
							"YQT" => "Thunder Bay",
							"TSN" => "Tianjin",
							"TIJ" => "Tijuana",
							"TIU" => "Timaru",
							"TOM" => "Timbuktu",
							"TIM" => "Timika",
							"TSR" => "Timisoara",
							"TGI" => "Tingo Mari",
							"TIQ" => "Tinian (island)",
							"TOD" => "Tioman",
							"TIA" => "Tirana (capital city)",
							"TRE" => "Tiree (island)",
							"TRZ" => "Tiruchirapally",
							"TIR" => "Tirupati",
							"TIX" => "Titusville (FL)",
							"TIV" => "Tivat",
							"TZM" => "Tizimin",
							"TMM" => "Toamasina",
							"TOB" => "Tobruk",
							"TAB" => "Tobago",
							"TKS" => "Tokushima",
							"TYO" => "Tokyo (capital city)",
							"HND" => "Tokyo - Japan, Haneda Arpt",
							"NRT" => "Tokyo [NRT]",
							"TOL" => "Toledo (OH)",
							"TLC" => "Toluca (near Mexico City)",
							"TPR" => "Tom Price",
							"TOF" => "Tomsk",
							"TNH" => "Tonghua",
							"TEN" => "Tongren",
							"TWB" => "Toowoomba",
							"FOE" => "Topeka (KS)",
							"YTO" => "Toronto [YTO]",
							"YYZ" => "Toronto [YKZ]",
							"YTZ" => "Toronto [YTZ]",
							"TRC" => "Torreon",
							"TTQ" => "Tortuguero",
							"TOU" => "Touho",
							"TLN" => "Toulon",
							"TLS" => "Toulouse",
							"TUF" => "Tours",
							"TSV" => "Townsville",
							"TOY" => "Toyama",
							"TZX" => "Trabzon",
							"TST" => "Trang",
							"TPS" => "Trapani",
							"TDX" => "Trat",
							"TVC" => "Traverse City (MI)",
							"TCB" => "Treasure Cay",
							"TTN" => "Trenton (NJ)",
							"TSF" => "Treviso",
							"TRS" => "Trieste",
							"TRI" => "Tri-Cities (TN/VA)",
							"TRR" => "Trincomalee",
							"POS" => "Trinidad (island)",
							"TDD" => "Trinidad",
							"TIP" => "Tripoli (capital city)",
							"TRV" => "Trivandrum (Thiruvananthapuram)",
							"TOS" => "Tromsoe (Troms )",
							"TRD" => "Trondheim",
							"QYR" => "Troyes",
							"TKF" => "Truckee (CA)",
							"TRU" => "Trujillo",
							"TSB" => "Tsumeb",
							"TUS" => "Tucson (AZ)",
							"TUC" => "Tucuman",
							"TUG" => "Tuguegarao",
							"TLR" => "Tulare (CA)",
							"TUA" => "Tulcan",
							"THA" => "Tullahoma (TN)",
							"TUP" => "Tupelo (MS)",
							"TUL" => "Tulsa (OK)",
							"TBP" => "Tumbes",
							"TUN" => "Tunis (capital city)",
							"TUK" => "Turbat",
							"TRN" => "Turin",
							"TKU" => "Turku",
							"TCL" => "Tuscaloosa (AL)",
							"TGZ" => "Tuxtla Gutierrez",
							"TWF" => "Twin Falls (ID)",
							"TYR" => "Tyler (TX)",
							"TJM" => "Tyumen",
							"UAH" => "Ua Huka (island)",
							"UAP" => "Ua Pou (island)",
							"UBJ" => "Ube",
							"UBA" => "Uberaba",
							"UDI" => "Uberlandia",
							"UBP" => "Ubon Ratchathani",
							"UDR" => "Udaipur",
							"UTH" => "Udon Thani",
							"UFA" => "Ufa",
							"UHE" => "Uherske Hradiste",
							"UGO" => "Uige",
							"UPG" => "Ujung Pandang (Makassar)",
							"UCT" => "Ukhta",
							"UKI" => "Ukiah (CA)",
							"ULN" => "Ulaanbaatar (capital city)",
							"ULO" => "Ulaangom",
							"HLH" => "Ulanhot",
							"UUD" => "Ulan-Ude",
							"ULB" => "Ulei",
							"ULG" => "Ulgii (Olgii)",
							"USN" => "Ulsan",
							"ULD" => "Ulundi",
							"ULV" => "Ulyanovsk [ULV]",
							"ULY" => "Ulyanovsk [ULY]",
							"UME" => "Umea",
							"UMT" => "Umiat (AK)",
							"YUD" => "Umiujaq",
							"UNK" => "Unalakleet (AK)",
							"UCY" => "Union City (TN)",
							"UNI" => "Union Island",
							"UNT" => "Unst (Shetland Island)",
							"UPL" => "Upala",
							"JUV" => "Upernavik",
							"UTN" => "Upington",
							"UPP" => "Upolu Point (HI)",
							"YBE" => "Uranium City",
							"URJ" => "Uray",
							"UGC" => "Urgench",
							"URM" => "Uriman",
							"OMH" => "Urmia (Urmieh)",
							"UPN" => "Uruapan",
							"URB" => "Urubupunga",
							"URG" => "Uruguaiana",
							"URC" => "Urumqi",
							"URZ" => "Uruzgan",
							"USQ" => "Usak",
							"USH" => "Ushuaia",
							"UIK" => "Ust-Ilimsk",
							"UKX" => "Ust-Kut",
							"UKG" => "Ust-Kuyga",
							"UTP" => "Utapao (Pattaya)",
							"UCA" => "Utica (NY)",
							"UII" => "Utila (island)",
							"UVA" => "Uvalde (TX)",
							"UMD" => "Uummannaq",
							"UYU" => "Uyuni",
							"UDJ" => "Uzhgorod",
							"UZC" => "Uzice",
							"VAA" => "Vaasa",
							"VDS" => "Vadso",
							"VXO" => "Vaexjoe (Vaxjo)",
							"EGE" => "Vail (CO)",
							"YVO" => "Val d'Or",
							"VDZ" => "Valdez (AK)",
							"VLD" => "Valdosta (GA)",
							"VAF" => "Valence [VAF]",
							"VLC" => "Valencia [VLC]",
							"VLN" => "Valencia [VLN]",
							"VLV" => "Valera",
							"VLL" => "Valladolid",
							"VDP" => "Valle de la Pascua",
							"VUP" => "Valledupar",
							"VPZ" => "Valparaiso, (IN)",
							"VAP" => "Valparaiso (Vi a del Mar)",
							"VDE" => "Valverde (Canary Islands)",
							"VAN" => "Van",
							"YVR" => "Vancouver",
							"VNY" => "Van Nuys (Los Angeles)",
							"VRA" => "Varadero",
							"VNS" => "Varanasi",
							"VAW" => "Vardo (Vard )",
							"VAG" => "Varginha",
							"VRK" => "Varkaus",
							"VAR" => "Varna",
							"VST" => "Vasteras",
							"XCR" => "Vatry",
							"VLU" => "Velikiye Luki (Welikije Luki)",
							"VCE" => "Venice",
							"VNT" => "Ventspils",
							"VER" => "Veracruz",
							"VEL" => "Vernal (UT)",
							"VRB" => "Vero Beach/Ft. Pierce (FL)",
							"VBS" => "Verona - Brescia - Montichiari",
							"VRN" => "Verona",
							"VEY" => "Vestmannaeyjar",
							"VIC" => "Vicenza",
							"VCH" => "Vichadero",
							"YYJ" => "Victoria [YYJ]",
							"SEZ" => "Victoria (Port Victoria) [SEZ]",
							"VCT" => "Victoria (TX) [VCT]",
							"VFA" => "Victoria Falls [VFA]",
							"VCV" => "Victorville (CA)",
							"VID" => "Vidin",
							"VDM" => "Viedma",
							"VIE" => "Vienna (Wien, capital city)",
							"VTE" => "Vientiane",
							"VQS" => "Vieques (island)",
							"VGO" => "Vigo",
							"VGA" => "Vijayawada",
							"VNX" => "Vilankulo",
							"VRL" => "Vila Real",
							"VLG" => "Villa Gesell",
							"VSA" => "Villahermosa",
							"VNO" => "Vilnius (Wilna)",
							"VII" => "Vinh",
							"VRC" => "Virac",
							"VIJ" => "Virgin Gorda",
							"VTZ" => "Visakhapatnam",
							"VIS" => "Visalia (CA)",
							"VBY" => "Visby",
							"VIX" => "Vitoria",
							"VDC" => "Vitoria da Conquista",
							"VIT" => "Vitoria-Gasteiz",
							"VVO" => "Vladivostok",
							"VOG" => "Volgograd",
							"VOL" => "Volos",
							"VOZ" => "Voronezh",
							"VYD" => "Vryheid",
							"YWK" => "Wabush",
							"ACT" => "Waco (TX)",
							"WHF" => "Wadi Halfa",
							"WGA" => "Wagga Wagga",
							"WGP" => "Waingapu",
							"WKJ" => "Wakkanai",
							"ALW" => "Walla Walla (WA)",
							"WLS" => "Wallis (island)",
							"WVB" => "Walvis Bay",
							"WKA" => "Wanaka",
							"WOT" => "Wang-an",
							"WXN" => "Wanzhou (district)",
							"WMB" => "Warrnambool",
							"WAW" => "Warsaw (capital city)",
							"WMI" => "Warsaw",
							"WAS" => "Washington D.C. (capital city) [WAS]",
							"BWI" => "Washington D.C. [BWI]",
							"IAD" => "Washington D.C. [IAD]",
							"DCA" => "Washington D.C. [DCA]",
							"WAT" => "Waterford",
							"ALO" => "Waterloo (IA)",
							"YKF" => "Woolwich",
							"ART" => "Watertown (NY) [ART]",
							"ATY" => "Watertown (SD) [ATY]",
							"CWA" => "Wausau/Stevens Point (WI)",
							"WAY" => "Waynesburg (PA)",
							"WEF" => "Weifang",
							"WEH" => "Weihai",
							"WEI" => "Weipa",
							"WEL" => "Welkom",
							"WLG" => "Wellington (capital city)",
							"EAT" => "Wenatchee (WA)",
							"TKK" => "Weno (island)",
							"WNZ" => "Wenzhou",
							"GWT" => "Westerland",
							"PBI" => "West Palm Beach (FL)",
							"WSZ" => "Westport",
							"WYS" => "West Yellowstone (MT)",
							"WHK" => "Whakatane",
							"YXN" => "Whale Cove",
							"WAG" => "Whanganui",
							"WRE" => "Whangarei",
							"HPN" => "White Plains (NY)",
							"YXY" => "Whitehorse",
							"WTR" => "Whiteriver (AZ)",
							"PPP" => "Whitsunday Islands",
							"WYA" => "Whyalla",
							"SPS" => "Wichita Falls (TX)",
							"ICT" => "Wichita (KS)",
							"WIC" => "Wick",
							"VIE" => "Wien (Vienna)",
							"WIE" => "Wiesbaden",
							"AVP" => "Wilkes Barre-Scranton (PA)",
							"CUR" => "Willemstad",
							"YWL" => "Williams Lake",
							"IPT" => "Williamsport (PA)",
							"ISN" => "Williston (ND)",
							"ILM" => "Wilmington (NC)",
							"VNO" => "Wilna (Vilnius; capital city)",
							"WUN" => "Wiluna",
							"WGO" => "Winchester (VA)",
							"WDH" => "Windhoek (capital city)",
							"WDH" => "Windhoek [WDH]",
							"ERS" => "Windhoek [ERS]",
							"YQG" => "Windsor",
							"WLD" => "Winfield (KS)",
							"WMC" => "Winnemucca (NV)",
							"YWG" => "Winnipeg",
							"OLF" => "Wolf Point (MT)",
							"WOL" => "Wollongong",
							"WJU" => "Wonju",
							"WWR" => "Woodward (OK)",
							"YKF" => "Woolwich",
							"ORH" => "Worcester (MA)",
							"WRL" => "Worland (WY)",
							"WRG" => "Wrangell (AK)",
							"YWY" => "Wrigley",
							"WRO" => "Wroclaw",
							"WUA" => "Wuhai",
							"WUH" => "Wuhan",
							"WUX" => "Wuxi, Suzhou",
							"WUZ" => "Wuzhou",
							"WYN" => "Wyndham",
							"XGN" => "Xangongo",
							"XMN" => "Xiamen",
							"XFN" => "Xiangyang",
							"XIY" => "Xi'an - Xianyang",
							"XIC" => "Xichang",
							"XKH" => "Xieng Khouang (Phonsavan)",
							"XIL" => "Xilinhot",
							"XIG" => "Xinguara",
							"XNT" => "Xingtai",
							"XNN" => "Xining",
							"XUZ" => "Xuzhou",
							"BCD" => "Bacolod",
							"CEB" => "Cebu",
							"CRK" => "Clark",
							"DVO" => "Davao ",
							"GES" => "General Santos ",
							"ILO" => "Iloilo ",
							"KLO" => "Kalibo ",
							"LAO" => "Laoag",
							"PPS" => "Puerto Princesa ",
							"ZAM" => "Zamboanga ",
							"SIN" => "Singapore"
						  		);  
	   return  $airports;      

 		}


	public function get_iairlines()
	{

		$airlines = array(
	                       "ANA"  =>  "ANA",
	                       "AVIANCA" => "AVIANCA",
	                       "Adria Airways" => "Adria Airways",
	                       "Aer Arann" => "Aer Arann",
	                       "Aer Lingus" => "Aer Lingus",
	                       "Aeroflot" => "Aeroflot",
	                       "Aeromar" => "Aeromar",
	                       "Aeromexico" => "Aeromexico",
	                       "Aeropelican Air Services" => "Aeropelican Air Services",
	                       "Aerosvit Airlines" => "Aerosvit Airlines",
	                       "Air Algerie" => "Air Algerie",
	                       "Air Arabia" => "Air Arabia",
	                       "Air Astana" => "Air Astana",
	                       "Air Baltic" => "Air Baltic",
	                       "Air Botswana" => "Air Botswana",
	                       "Air Canada" => "Air Canada",
	                       "Air China" => "Air China",
	                       "Air Dolomiti" => "Air Dolomiti",
	                       "Air Europa Lineas Aereas" => "Air Europa Lineas Aereas",
	                       "Air France" => "Air France",
	                       "Air India IC" => "Air India IC",
	                       "Air Macau" => "Air Macau",
	                       "Air Madagascar" => "Air Madagascar",
	                       "Air Malta" => "Air Malta",
	                       "Air Mauritius" => "Air Mauritius",
	                       "Air Namibia" => "Air Namibia",
	                       "Air New Zealand" => "Air New Zealand",
						   "Air Niugini" => "Air Niugini",
						   "Air One" => "Air One"
   	                     );  
	   return  $airlines;     
	}


	public function get_parsed_data($decoded_flight_data,$type)
	{

		if ($type == 1) {

		$parsed_data = $decoded_flight_data['CarrierID'].'|^@^|'.$decoded_flight_data['FlightNumber'].'|^@^|'.$decoded_flight_data['Source'].'|^@^|'.$decoded_flight_data['Destination'].'|^@^|'.$decoded_flight_data['DepartureTimeStamp'].'|^@^|'.$decoded_flight_data['ArrivalTimeStamp'].'|^@^|'.$decoded_flight_data['Class'].'|^@^|'.$decoded_flight_data['FareBasis'];
			
		}else{
			unset($decoded_flight_data['MarkupFee']);
			unset($decoded_flight_data['is_available']);
			$parsed_data = "currency:".$decoded_flight_data['currency'].",BaseFareFee:".$decoded_flight_data['BaseFareFee'].",TaxFee:".$decoded_flight_data['TaxFee'].",SystemFee:".$decoded_flight_data['SystemFee'].",TotalFee:".$decoded_flight_data['TotalFee'];
		}

		 return $parsed_data;
	}

	public function get_parsed_Newdata($provider,$decoded_flight_data,$decoded_flight_dataCon2,$decoded_flight_dataCon3=null,$type=null)
	{

		if ($type == 1) {

		//$parsed_data = $decoded_flight_data['CarrierID'].'|^@^|'.$decoded_flight_data['FlightNumber'].'|^@^|'.$decoded_flight_data['Source'].'|^@^|'.$decoded_flight_data['Destination'].'|^@^|'.$decoded_flight_data['DepartureTimeStamp'].'|^@^|'.$decoded_flight_data['ArrivalTimeStamp'].'|^@^|'.$decoded_flight_data['Class'].'|^@^|'.$decoded_flight_data['FareBasis'];
			// var_dump($decoded_flight_data);exit();

			$parsed_data 	= '';
			$f_con3 		= $decoded_flight_dataCon3;
			$f_con2 		= $decoded_flight_dataCon2;
			$f 				= $decoded_flight_data;
				
			if($provider=='via'){
					
				if(isset($decoded_flight_data) && isset($decoded_flight_dataCon2) && isset($decoded_flight_dataCon3) ) {
					// echo '3'; exit();
					$parsed_data .= $f['CarrierID'] .'|^@^|'. $f['FlightNumber'] .'|^@^|'. $f['Source'] .'|^@^|'. $f['Destination'] .'|^@^|'. $f['DepartureTimeStamp'] .'|^@^|'. $f['ArrivalTimeStamp'] .'|^@^|'. $f['Class']. '|^@^|'. $f['FareBasis'].'|*|'.$f_con2['CarrierID'] .'|^@^|'. $f_con2['FlightNumber'] .'|^@^|'. $f_con2['Source'] .'|^@^|'. $f_con2['Destination'] .'|^@^|'. $f_con2['DepartureTimeStamp'] .'|^@^|'. $f_con2['ArrivalTimeStamp'] .'|^@^|'. $f_con2['Class']. '|^@^|'. $f_con2['FareBasis'].'|*|'.$f_con3['CarrierID'] .'|^@^|'. $f_con3['FlightNumber'] .'|^@^|'. $f_con3['Source'] .'|^@^|'. $f_con3['Destination'] .'|^@^|'. $f_con3['DepartureTimeStamp'] .'|^@^|'. $f_con3['ArrivalTimeStamp'] .'|^@^|'. $f_con3['Class']. '|^@^|'. $f_con3['FareBasis'];
				} elseif (isset($decoded_flight_data) && isset($decoded_flight_dataCon2) && $decoded_flight_dataCon3=="") {
					// echo '2'; exit();
					$parsed_data .= $f['CarrierID'] .'|^@^|'. $f['FlightNumber'] .'|^@^|'. $f['Source'] .'|^@^|'. $f['Destination'] .'|^@^|'. $f['DepartureTimeStamp'] .'|^@^|'. $f['ArrivalTimeStamp'] .'|^@^|'. $f['Class']. '|^@^|'. $f['FareBasis'].'|*|'.$f_con2['CarrierID'] .'|^@^|'. $f_con2['FlightNumber'] .'|^@^|'. $f_con2['Source'] .'|^@^|'. $f_con2['Destination'] .'|^@^|'. $f_con2['DepartureTimeStamp'] .'|^@^|'. $f_con2['ArrivalTimeStamp'] .'|^@^|'. $f_con2['Class']. '|^@^|'. $f_con2['FareBasis'];
				} else {
					// echo '1'; exit();
					$parsed_data .= $f['CarrierID'] .'|^@^|'. $f['FlightNumber'] .'|^@^|'. $f['Source'] .'|^@^|'. $f['Destination'] .'|^@^|'. $f['DepartureTimeStamp'] .'|^@^|'. $f['ArrivalTimeStamp'] .'|^@^|'. $f['Class']. '|^@^|'. $f['FareBasis'];
				}

			}else if($provider=='abacus'){
				
				if(isset($decoded_flight_data) && isset($decoded_flight_dataCon2) && isset($decoded_flight_dataCon3) ) {
					// echo '3'; exit();
					$parsed_data .= $f['CarrierID'] .'|^@^|'. $f['FlightNumber'] .'|^@^|'. $f['Source'] .'|^@^|'. $f['Destination'] .'|^@^|'. $f['DepartureTimeStamp'] .'|^@^|'. $f['ArrivalTimeStamp'] .'|^@^|'. $f['Class']. '|^@^|'. $f['FareBasis'] . '|^@^|'. $f['ResBookDesigCode'] . '|^@^|'. $f['MarketingAirline'] . '|^@^|'. $f['OperatingAirline'].'|*|'.$f_con2['CarrierID'] .'|^@^|'. $f_con2['FlightNumber'] .'|^@^|'. $f_con2['Source'] .'|^@^|'. $f_con2['Destination'] .'|^@^|'. $f_con2['DepartureTimeStamp'] .'|^@^|'. $f_con2['ArrivalTimeStamp'] .'|^@^|'. $f_con2['Class']. '|^@^|'. $f_con2['FareBasis'] . '|^@^|'. $f_con2['ResBookDesigCode'] . '|^@^|'. $f_con2['MarketingAirline'] . '|^@^|'. $f_con2['OperatingAirline'].'|*|'.$f_con3['CarrierID'] .'|^@^|'. $f_con3['FlightNumber'] .'|^@^|'. $f_con3['Source'] .'|^@^|'. $f_con3['Destination'] .'|^@^|'. $f_con3['DepartureTimeStamp'] .'|^@^|'. $f_con3['ArrivalTimeStamp'] .'|^@^|'. $f_con3['Class']. '|^@^|'. $f_con3['FareBasis'] . '|^@^|'. $f_con3['ResBookDesigCode'] . '|^@^|'. $f_con3['MarketingAirline'] . '|^@^|'. $f_con3['OperatingAirline'];
				} elseif (isset($decoded_flight_data) && isset($decoded_flight_dataCon2) && $decoded_flight_dataCon3=="") {
					// echo '2'; exit();
					$parsed_data .= $f['CarrierID'] .'|^@^|'. $f['FlightNumber'] .'|^@^|'. $f['Source'] .'|^@^|'. $f['Destination'] .'|^@^|'. $f['DepartureTimeStamp'] .'|^@^|'. $f['ArrivalTimeStamp'] .'|^@^|'. $f['Class']. '|^@^|'. $f['FareBasis'] . '|^@^|'. $f['ResBookDesigCode'] . '|^@^|'. $f['MarketingAirline'] . '|^@^|'. $f['OperatingAirline'].'|*|'.$f_con2['CarrierID'] .'|^@^|'. $f_con2['FlightNumber'] .'|^@^|'. $f_con2['Source'] .'|^@^|'. $f_con2['Destination'] .'|^@^|'. $f_con2['DepartureTimeStamp'] .'|^@^|'. $f_con2['ArrivalTimeStamp'] .'|^@^|'. $f_con2['Class']. '|^@^|'. $f_con2['FareBasis'] . '|^@^|'. $f_con2['ResBookDesigCode'] . '|^@^|'. $f_con2['MarketingAirline'] . '|^@^|'. $f_con2['OperatingAirline'];
				} else {
					// echo '1'; exit();
					$parsed_data .= $f['CarrierID'] .'|^@^|'. $f['FlightNumber'] .'|^@^|'. $f['Source'] .'|^@^|'. $f['Destination'] .'|^@^|'. $f['DepartureTimeStamp'] .'|^@^|'. $f['ArrivalTimeStamp'] .'|^@^|'. $f['Class']. '|^@^|'. $f['FareBasis'] . '|^@^|'. $f['ResBookDesigCode'] . '|^@^|'. $f['MarketingAirline'] . '|^@^|'. $f['OperatingAirline'];
				}
			
			}else if($provider=='byaheko'){
				
				if(isset($decoded_flight_data) && isset($decoded_flight_dataCon2) && isset($decoded_flight_dataCon3) ) {
					// echo '3'; exit();
					$parsed_data .= $f['CarrierID'] .'|^@^|'. $f['FlightNumber'] .'|^@^|'. $f['Source'] .'|^@^|'. $f['Destination'] .'|^@^|'. $f['DepartureTimeStamp'] .'|^@^|'. $f['ArrivalTimeStamp'] .'|^@^|'. $f['Class']. '|^@^|'. $f['FareBasis'].'|*|'.$f_con2['CarrierID'] .'|^@^|'. $f_con2['FlightNumber'] .'|^@^|'. $f_con2['Source'] .'|^@^|'. $f_con2['Destination'] .'|^@^|'. $f_con2['DepartureTimeStamp'] .'|^@^|'. $f_con2['ArrivalTimeStamp'] .'|^@^|'. $f_con2['Class']. '|^@^|'. $f_con2['FareBasis'].'|*|'.$f_con3['CarrierID'] .'|^@^|'. $f_con3['FlightNumber'] .'|^@^|'. $f_con3['Source'] .'|^@^|'. $f_con3['Destination'] .'|^@^|'. $f_con3['DepartureTimeStamp'] .'|^@^|'. $f_con3['ArrivalTimeStamp'] .'|^@^|'. $f_con3['Class']. '|^@^|'. $f_con3['FareBasis'];
				} elseif (isset($decoded_flight_data) && isset($decoded_flight_dataCon2) && $decoded_flight_dataCon3=="") {
					// echo '2'; exit();
					$parsed_data .= $f['CarrierID'] .'|^@^|'. $f['FlightNumber'] .'|^@^|'. $f['Source'] .'|^@^|'. $f['Destination'] .'|^@^|'. $f['DepartureTimeStamp'] .'|^@^|'. $f['ArrivalTimeStamp'] .'|^@^|'. $f['Class']. '|^@^|'. $f['FareBasis'].'|*|'.$f_con2['CarrierID'] .'|^@^|'. $f_con2['FlightNumber'] .'|^@^|'. $f_con2['Source'] .'|^@^|'. $f_con2['Destination'] .'|^@^|'. $f_con2['DepartureTimeStamp'] .'|^@^|'. $f_con2['ArrivalTimeStamp'] .'|^@^|'. $f_con2['Class']. '|^@^|'. $f_con2['FareBasis'];
				} else {
					// echo '1'; exit();
					$parsed_data .= $f['CarrierID'] .'|^@^|'. $f['FlightNumber'] .'|^@^|'. $f['Source'] .'|^@^|'. $f['Destination'] .'|^@^|'. $f['DepartureTimeStamp'] .'|^@^|'. $f['ArrivalTimeStamp'] .'|^@^|'. $f['Class']. '|^@^|'. $f['FareBasis'];
				}

			} else if($provider=='amadeus'){
				
				if(isset($decoded_flight_data) && isset($decoded_flight_dataCon2) && isset($decoded_flight_dataCon3) ) {
					// echo '3'; exit();
					$parsed_data .= $f['CarrierID'] .'|^@^|'. $f['FlightNumber'] .'|^@^|'. $f['Source'] .'|^@^|'. $f['Destination'] .'|^@^|'. $f['DepartureTimeStamp'] .'|^@^|'. $f['ArrivalTimeStamp'] .'|^@^|'. $f['Class']. '|^@^|'. $f['FareBasis'] . '|^@^|'. $f['ResBookDesigCode'] . '|^@^|'. $f['MarketingAirline'] . '|^@^|'. $f['OperatingAirline']. '|^@^|'. $f['S_Terminal']. '|^@^|'. $f['D_Terminal']. '|^@^|'. $f['FreeBaggage'].'|*|'.$f_con2['CarrierID'] .'|^@^|'. $f_con2['FlightNumber'] .'|^@^|'. $f_con2['Source'] .'|^@^|'. $f_con2['Destination'] .'|^@^|'. $f_con2['DepartureTimeStamp'] .'|^@^|'. $f_con2['ArrivalTimeStamp'] .'|^@^|'. $f_con2['Class']. '|^@^|'. $f_con2['FareBasis'] . '|^@^|'. $f_con2['ResBookDesigCode'] . '|^@^|'. $f_con2['MarketingAirline'] . '|^@^|'. $f_con2['OperatingAirline']. '|^@^|'. $f_con2['S_Terminal']. '|^@^|'. $f_con2['D_Terminal']. '|^@^|'. $f['FreeBaggage'].'|*|'.$f_con3['CarrierID'] .'|^@^|'. $f_con3['FlightNumber'] .'|^@^|'. $f_con3['Source'] .'|^@^|'. $f_con3['Destination'] .'|^@^|'. $f_con3['DepartureTimeStamp'] .'|^@^|'. $f_con3['ArrivalTimeStamp'] .'|^@^|'. $f_con3['Class']. '|^@^|'. $f_con3['FareBasis'] . '|^@^|'. $f_con3['ResBookDesigCode'] . '|^@^|'. $f_con3['MarketingAirline'] . '|^@^|'. $f_con3['OperatingAirline']. '|^@^|'. $f_con3['S_Terminal']. '|^@^|'. $f_con3['D_Terminal']. '|^@^|'. $f['FreeBaggage'];
				} elseif (isset($decoded_flight_data) && isset($decoded_flight_dataCon2) && $decoded_flight_dataCon3=="") {
					// echo '2'; exit();
					$parsed_data .= $f['CarrierID'] .'|^@^|'. $f['FlightNumber'] .'|^@^|'. $f['Source'] .'|^@^|'. $f['Destination'] .'|^@^|'. $f['DepartureTimeStamp'] .'|^@^|'. $f['ArrivalTimeStamp'] .'|^@^|'. $f['Class']. '|^@^|'. $f['FareBasis'] . '|^@^|'. $f['ResBookDesigCode'] . '|^@^|'. $f['MarketingAirline'] . '|^@^|'. $f['OperatingAirline']. '|^@^|'. $f['S_Terminal']. '|^@^|'. $f['D_Terminal']. '|^@^|'. $f['FreeBaggage'].'|*|'.$f_con2['CarrierID'] .'|^@^|'. $f_con2['FlightNumber'] .'|^@^|'. $f_con2['Source'] .'|^@^|'. $f_con2['Destination'] .'|^@^|'. $f_con2['DepartureTimeStamp'] .'|^@^|'. $f_con2['ArrivalTimeStamp'] .'|^@^|'. $f_con2['Class']. '|^@^|'. $f_con2['FareBasis'] . '|^@^|'. $f_con2['ResBookDesigCode'] . '|^@^|'. $f_con2['MarketingAirline'] . '|^@^|'. $f_con2['OperatingAirline']. '|^@^|'. $f_con2['S_Terminal']. '|^@^|'. $f_con2['D_Terminal']. '|^@^|'. $f['FreeBaggage'];
				} else {
					// echo '1'; exit();
					$parsed_data .= $f['CarrierID'] .'|^@^|'. $f['FlightNumber'] .'|^@^|'. $f['Source'] .'|^@^|'. $f['Destination'] .'|^@^|'. $f['DepartureTimeStamp'] .'|^@^|'. $f['ArrivalTimeStamp'] .'|^@^|'. $f['Class']. '|^@^|'. $f['FareBasis'] . '|^@^|'. $f['ResBookDesigCode'] . '|^@^|'. $f['MarketingAirline'] . '|^@^|'. $f['OperatingAirline']. '|^@^|'. $f['S_Terminal']. '|^@^|'. $f['D_Terminal']. '|^@^|'. $f['FreeBaggage'];
				}

			} else if($provider=='scoot'){
				
				if(isset($decoded_flight_data) && isset($decoded_flight_dataCon2) && isset($decoded_flight_dataCon3) ) {
					// echo '3'; exit();
					$parsed_data .= $f['CarrierID'] .'|^@^|'. $f['FlightNumber'] .'|^@^|'. $f['Source'] .'|^@^|'. $f['Destination'] .'|^@^|'. $f['DepartureTimeStamp'] .'|^@^|'. $f['ArrivalTimeStamp'] .'|^@^|'. $f['Class']. '|^@^|'. $f['FareBasis'] . '|^@^|'. $f['ResBookDesigCode'] . '|^@^|'. $f['MarketingAirline'] . '|^@^|'. $f['OperatingAirline']. '|^@^|'. $f['S_Terminal']. '|^@^|'. $f['D_Terminal'].'|*|'.$f_con2['CarrierID'] .'|^@^|'. $f_con2['FlightNumber'] .'|^@^|'. $f_con2['Source'] .'|^@^|'. $f_con2['Destination'] .'|^@^|'. $f_con2['DepartureTimeStamp'] .'|^@^|'. $f_con2['ArrivalTimeStamp'] .'|^@^|'. $f_con2['Class']. '|^@^|'. $f_con2['FareBasis'] . '|^@^|'. $f_con2['ResBookDesigCode'] . '|^@^|'. $f_con2['MarketingAirline'] . '|^@^|'. $f_con2['OperatingAirline']. '|^@^|'. $f_con2['S_Terminal']. '|^@^|'. $f_con2['D_Terminal'].'|*|'.$f_con3['CarrierID'] .'|^@^|'. $f_con3['FlightNumber'] .'|^@^|'. $f_con3['Source'] .'|^@^|'. $f_con3['Destination'] .'|^@^|'. $f_con3['DepartureTimeStamp'] .'|^@^|'. $f_con3['ArrivalTimeStamp'] .'|^@^|'. $f_con3['Class']. '|^@^|'. $f_con3['FareBasis'] . '|^@^|'. $f_con3['ResBookDesigCode'] . '|^@^|'. $f_con3['MarketingAirline'] . '|^@^|'. $f_con3['OperatingAirline']. '|^@^|'. $f_con3['S_Terminal']. '|^@^|'. $f_con3['D_Terminal'];
				} elseif (isset($decoded_flight_data) && isset($decoded_flight_dataCon2) && $decoded_flight_dataCon3=="") {
					// echo '2'; exit();
					$parsed_data .= $f['CarrierID'] .'|^@^|'. $f['FlightNumber'] .'|^@^|'. $f['Source'] .'|^@^|'. $f['Destination'] .'|^@^|'. $f['DepartureTimeStamp'] .'|^@^|'. $f['ArrivalTimeStamp'] .'|^@^|'. $f['Class']. '|^@^|'. $f['FareBasis'] . '|^@^|'. $f['ResBookDesigCode'] . '|^@^|'. $f['MarketingAirline'] . '|^@^|'. $f['OperatingAirline']. '|^@^|'. $f['S_Terminal']. '|^@^|'. $f['D_Terminal'].'|*|'.$f_con2['CarrierID'] .'|^@^|'. $f_con2['FlightNumber'] .'|^@^|'. $f_con2['Source'] .'|^@^|'. $f_con2['Destination'] .'|^@^|'. $f_con2['DepartureTimeStamp'] .'|^@^|'. $f_con2['ArrivalTimeStamp'] .'|^@^|'. $f_con2['Class']. '|^@^|'. $f_con2['FareBasis'] . '|^@^|'. $f_con2['ResBookDesigCode'] . '|^@^|'. $f_con2['MarketingAirline'] . '|^@^|'. $f_con2['OperatingAirline']. '|^@^|'. $f_con2['S_Terminal']. '|^@^|'. $f_con2['D_Terminal'];
				} else {
					// echo '1'; exit();
					$parsed_data .= $f['CarrierID'] .'|^@^|'. $f['FlightNumber'] .'|^@^|'. $f['Source'] .'|^@^|'. $f['Destination'] .'|^@^|'. $f['DepartureTimeStamp'] .'|^@^|'. $f['ArrivalTimeStamp'] .'|^@^|'. $f['Class']. '|^@^|'. $f['FareBasis'] . '|^@^|'. $f['ResBookDesigCode'] . '|^@^|'. $f['MarketingAirline'] . '|^@^|'. $f['OperatingAirline']. '|^@^|'. $f['S_Terminal']. '|^@^|'. $f['D_Terminal'];
				}

			}
			
		}else{
			
			unset($decoded_flight_data['MarkupFee']);
			unset($decoded_flight_data['is_available']);

			// $parsed_data = "currency:".$decoded_flight_data['currency'].",BaseFareFee:".$decoded_flight_data['BaseFareFee'].",TaxFee:".$decoded_flight_data['TaxFee'].",SystemFee:".$decoded_flight_data['SystemFee'].",TotalFee:".$decoded_flight_data['TotalFee'];

			if($provider=='amadeus' || $provider=='abacus'){
				$parsed_data = "currency:".$decoded_flight_data['currency'].",BaseFareFee:".$decoded_flight_data['BaseFareFee'].",TaxFee:".$decoded_flight_data['TaxFee'].",SystemFee:".$decoded_flight_data['SystemFee'].",TotalFee:".$decoded_flight_data['TotalFee'].",validatingAirline:".$decoded_flight_data['validatingAirlineCode'];

			} else {
				$parsed_data = "currency:".$decoded_flight_data['currency'].",BaseFareFee:".$decoded_flight_data['BaseFareFee'].",TaxFee:".$decoded_flight_data['TaxFee'].",SystemFee:".$decoded_flight_data['SystemFee'].",TotalFee:".$decoded_flight_data['TotalFee'];
			}

		}

		 return $parsed_data;
	}


		public function get_passengers_count($passenger)
	{
		$adult = 0;
		$children = 0;
		$infant = 0;

		for ($i=0; $i < count($passenger); $i++) { 
			if ($passenger[$i]['Type'] == 'A' || $passenger[$i]['Type'] == 'S') {
				$adult = $adult + 1;
			}elseif ($passenger[$i]['Type'] == 'C') {
				$children = $children + 1;
			}elseif ($passenger[$i]['Type'] == 'I') {
				$infant = $infant + 1;	
			}

			if ($passenger[$i]['Type'] == 'S') {
				$senior = 1;
			}else{
				$senior = 0;
			}
		}

		return array(
				'senior' => $senior,
				'adult' => $adult,
				'children' => $children,
				'infant' => $infant
			);
	}

	public function get_parsed_passengers($form_data)
	{
		$senior = array();
		$adult = array();
		$children = array();
		$infant = array();
		foreach ($form_data as $key => $value) {
			if (substr($key, 0, 2) == 's_') {
				array_push($senior, $value);
			}elseif (substr($key, 0, 2) == 'a_') {
				array_push($adult, $value);
			}elseif (substr($key, 0, 2) == 'c_') {
				array_push($children, $value);
			}elseif (substr($key, 0, 2) == 'i_'){
				array_push($infant, $value);
			}
		}

		$parsed_passengers = array();	
		if (count($senior) % 7 == 0) {
			foreach (array_chunk($senior, 7) as $key) {
				$dob = date("d/m/Y", strtotime($key[3]));
				array_push($parsed_passengers,'T:S|^@^|TL:'.$key[0].'|^@^|FN:'.$key[1].'|^@^|LN:'.$key[2].'|^@^|DOB:'.$dob.'|^@^|S:'.$key[4].'|^@^|OB:'.$key[5].'|^@^|RB:'.$key[6]);
			}
		}else{
			foreach (array_chunk($senior, 6) as $key) {
				$dob = date("d/m/Y", strtotime($key[3]));
				array_push($parsed_passengers,'T:S|^@^|TL:'.$key[0].'|^@^|FN:'.$key[1].'|^@^|LN:'.$key[2].'|^@^|DOB:'.$dob.'|^@^|S:'.$key[4].'|^@^|OB:'.$key[5].'|^@^|RB:');
			}
		}


		// if (count($adult) % 6 == 0) {
		if (count($adult) % 6 == 0 && $form_data['returnbaggages'] != 'null') {
			foreach (array_chunk($adult, 6) as $key) {
				$dob = date("d/m/Y", strtotime($key[3]));
				array_push($parsed_passengers,'T:A|^@^|TL:'.$key[0].'|^@^|FN:'.$key[1].'|^@^|LN:'.$key[2].'|^@^|DOB:'.$dob.'|^@^|S:|^@^|OB:'.$key[4].'|^@^|RB:'.$key[5]);
			}
		}
		else{
			foreach (array_chunk($adult, 5) as $key) {
				$dob = date("d/m/Y", strtotime($key[3]));
				array_push($parsed_passengers,'T:A|^@^|TL:'.$key[0].'|^@^|FN:'.$key[1].'|^@^|LN:'.$key[2].'|^@^|DOB:'.$dob.'|^@^|S:|^@^|OB:'.$key[4].'|^@^|RB:');
			}
		}

		// if (count($children) % 6 == 0) {
		if (count($children) % 6 == 0 && $form_data['returnbaggages'] != 'null') {
			foreach (array_chunk($children, 6) as $key) {
				$dob = date("d/m/Y", strtotime($key[3]));
				array_push($parsed_passengers,'T:C|^@^|TL:'.$key[0].'|^@^|FN:'.$key[1].'|^@^|LN:'.$key[2].'|^@^|DOB:'.$dob.'|^@^|S:|^@^|OB:'.$key[4].'|^@^|RB:'.$key[5]);
			}		

		}else{
			foreach (array_chunk($children, 5) as $key) {
				$dob = date("d/m/Y", strtotime($key[3]));
				array_push($parsed_passengers,'T:C|^@^|TL:'.$key[0].'|^@^|FN:'.$key[1].'|^@^|LN:'.$key[2].'|^@^|DOB:'.$dob.'|^@^|S:|^@^|OB:'.$key[4].'|^@^|RB:');
			}
		}

		if (count($infant) >= 1) {
			foreach (array_chunk($infant, 4) as $key) {
				$dob = date("d/m/Y", strtotime($key[3]));
				array_push($parsed_passengers,'T:I|^@^|TL:'.$key[0].'|^@^|FN:'.$key[1].'|^@^|LN:'.$key[2].'|^@^|DOB:'.$dob.'|^@^|S:|^@^|OB:0|^@^|RB:0');
			}
		}

		return implode('|*|', $parsed_passengers);

	}

	public function get_parsed_passengersByaheko($form_data)
	{
		$senior = array();
		$adult = array();
		$children = array();
		$infant = array();
		foreach ($form_data as $key => $value) {
			if (substr($key, 0, 2) == 's_') {
				array_push($senior, $value);
			}elseif (substr($key, 0, 2) == 'a_') {
				array_push($adult, $value);
			}elseif (substr($key, 0, 2) == 'c_') {
				array_push($children, $value);
			}elseif (substr($key, 0, 2) == 'i_'){
				array_push($infant, $value);
			}
		}

		$parsed_passengers = array();	
		if (count($senior) % 11 == 0) {
			foreach (array_chunk($senior, 11) as $key) {
				array_push($parsed_passengers,'T:S|^@^|TL:'.$key[0].'|^@^|FN:'.$key[1].'|^@^|LN:'.$key[2].'|^@^|DOB:'.$key[3].'|^@^|S:'.$key[4].'|^@^|OB:'.$key[5].'|^@^|RB:'.$key[6].'|^@^|PN:'.$key[7].'|^@^|PED:'.$key[8].'|^@^|PIC:'.$key[9].'|^@^|NAT:'.$key[10]);
			}
		}else{
			foreach (array_chunk($senior, 10) as $key) {
				array_push($parsed_passengers,'T:S|^@^|TL:'.$key[0].'|^@^|FN:'.$key[1].'|^@^|LN:'.$key[2].'|^@^|DOB:'.$key[3].'|^@^|S:'.$key[4].'|^@^|OB:'.$key[5].'|^@^|RB:'.'|^@^|PN:'.$key[6].'|^@^|PED:'.$key[7].'|^@^|PIC:'.$key[8].'|^@^|NAT:'.$key[9]);
			}
		}

		if (count($adult) % 10 == 0) {
			foreach (array_chunk($adult, 10) as $key) {
				array_push($parsed_passengers,'T:A|^@^|TL:'.$key[0].'|^@^|FN:'.$key[1].'|^@^|LN:'.$key[2].'|^@^|DOB:'.$key[3].'|^@^|S:|^@^|OB:'.$key[4].'|^@^|RB:'.$key[5].'|^@^|PN:'.$key[6].'|^@^|PED:'.$key[7].'|^@^|PIC:'.$key[8].'|^@^|NAT:'.$key[9]);
			}
		}
		else{
			foreach (array_chunk($adult, 9) as $key) {
				array_push($parsed_passengers,'T:A|^@^|TL:'.$key[0].'|^@^|FN:'.$key[1].'|^@^|LN:'.$key[2].'|^@^|DOB:'.$key[3].'|^@^|S:|^@^|OB:'.$key[4].'|^@^|RB:'.'|^@^|PN:'.$key[5].'|^@^|PED:'.$key[6].'|^@^|PIC:'.$key[7].'|^@^|NAT:'.$key[8]);
			}
		}

		if (count($children) % 10 == 0) {
			foreach (array_chunk($children, 10) as $key) {
				array_push($parsed_passengers,'T:C|^@^|TL:'.$key[0].'|^@^|FN:'.$key[1].'|^@^|LN:'.$key[2].'|^@^|DOB:'.$key[3].'|^@^|S:|^@^|OB:'.$key[4].'|^@^|RB:'.$key[5].'|^@^|PN:'.$key[6].'|^@^|PED:'.$key[7].'|^@^|PIC:'.$key[8].'|^@^|NAT:'.$key[9]);
			}		

		}else{
			foreach (array_chunk($children, 9) as $key) {
				array_push($parsed_passengers,'T:C|^@^|TL:'.$key[0].'|^@^|FN:'.$key[1].'|^@^|LN:'.$key[2].'|^@^|DOB:'.$key[3].'|^@^|S:|^@^|OB:'.$key[4].'|^@^|RB:'.'|^@^|PN:'.$key[5].'|^@^|PED:'.$key[6].'|^@^|PIC:'.$key[7].'|^@^|NAT:'.$key[8]);
			}
		}

		if (count($infant) >= 1) {
			foreach (array_chunk($infant, 8) as $key) {
				array_push($parsed_passengers,'T:I|^@^|TL:'.$key[0].'|^@^|FN:'.$key[1].'|^@^|LN:'.$key[2].'|^@^|DOB:'.$key[3].'|^@^|S:|^@^|OB:0|^@^|RB:0'.'|^@^|PN:'.$key[4].'|^@^|PED:'.$key[5].'|^@^|PIC:'.$key[6].'|^@^|NAT:'.$key[7]);
			}
		}

		return implode('|*|', $parsed_passengers);

	}

	public function get_parsed_passengersAmadeus($form_data)
	{
		$senior = array();
		$adult = array();
		$children = array();
		$infant = array();
		foreach ($form_data as $key => $value) {
			if (substr($key, 0, 2) == 's_') {
				array_push($senior, $value);
			}elseif (substr($key, 0, 2) == 'a_') {
				array_push($adult, $value);
			}elseif (substr($key, 0, 2) == 'c_') {
				array_push($children, $value);
			}elseif (substr($key, 0, 2) == 'i_'){
				array_push($infant, $value);
			}
		}

		$chosen = json_decode($form_data['choose_flights']);
		$total_adult  = (int)($chosen[0]->choosen[6]->Adult);
		$total_child  = (int)($chosen[0]->choosen[6]->Children);
		$total_infant = (int)($chosen[0]->choosen[6]->Infant);
		$total_senior = (int)($chosen[0]->choosen[6]->Senior);

		// var_dump(($children));
		// var_dump(count($children));
		// var_dump($form_data['returnbaggages']);
		$parsed_passengers = array();	
		if (count($senior) % 13 == 0) {
			foreach (array_chunk($senior, 13) as $key) {
				array_push($parsed_passengers,'T:S|^@^|TL:'.$key[0].'|^@^|FN:'.$key[1].'|^@^|LN:'.$key[2].'|^@^|DOB:'.$key[3].'|^@^|S:'.$key[4].'|^@^|OB:'.$key[5].'|^@^|RB:'.$key[6].'|^@^|PN:'.$key[7].'|^@^|PED:'.$key[8].'|^@^|PIC:'.$key[9].'|^@^|VN:'.$key[10].'|^@^|VED:'.$key[11].'|^@^|VIC:'.$key[12]);
			}
		}else{
			foreach (array_chunk($senior, 12) as $key) {
				array_push($parsed_passengers,'T:S|^@^|TL:'.$key[0].'|^@^|FN:'.$key[1].'|^@^|LN:'.$key[2].'|^@^|DOB:'.$key[3].'|^@^|S:'.$key[4].'|^@^|OB:'.$key[5].'|^@^|RB:'.'|^@^|PN:'.$key[6].'|^@^|PED:'.$key[7].'|^@^|PIC:'.$key[8].'|^@^|VN:'.$key[9].'|^@^|VED:'.$key[10].'|^@^|VIC:'.$key[11]);
			}
		}

		if (count($adult) % 12 == 0) {
			if(count($adult)/$total_adult == 8) {
			// if(count($adult)/$total_adult == 8 && $form_data['returnbaggages'] == 'null') {
				foreach (array_chunk($adult, 8) as $key) {
					array_push($parsed_passengers,'T:A|^@^|TL:'.$key[0].'|^@^|FN:'.$key[1].'|^@^|LN:'.$key[2].'|^@^|DOB:'.$key[3].'|^@^|S:|^@^|OB:'.$key[4].'|^@^|RB:'.'|^@^|PN:'.$key[5].'|^@^|PED:'.$key[6].'|^@^|PIC:'.$key[7].'|^@^|VN:'.'|^@^|VED:'.'|^@^|VIC:');
				}
			} else {
				foreach (array_chunk($adult, 12) as $key) {
					array_push($parsed_passengers,'T:A|^@^|TL:'.$key[0].'|^@^|FN:'.$key[1].'|^@^|LN:'.$key[2].'|^@^|DOB:'.$key[3].'|^@^|S:|^@^|OB:'.$key[4].'|^@^|RB:'.$key[5].'|^@^|PN:'.$key[6].'|^@^|PED:'.$key[7].'|^@^|PIC:'.$key[8].'|^@^|VN:'.$key[9].'|^@^|VED:'.$key[10].'|^@^|VIC:'.$key[11]);
				}
			}
					
		}
		elseif (count($adult) % 9 == 0) {
			foreach (array_chunk($adult, 9) as $key) {
				array_push($parsed_passengers,'T:A|^@^|TL:'.$key[0].'|^@^|FN:'.$key[1].'|^@^|LN:'.$key[2].'|^@^|DOB:'.$key[3].'|^@^|S:|^@^|OB:'.$key[4].'|^@^|RB:'.$key[5].'|^@^|PN:'.$key[6].'|^@^|PED:'.$key[7].'|^@^|PIC:'.$key[8].'|^@^|VN:'.'|^@^|VED:'.'|^@^|VIC:');
			}
		}
		elseif (count($adult) % 8== 0) {
			foreach (array_chunk($adult, 8) as $key) {
				array_push($parsed_passengers,'T:A|^@^|TL:'.$key[0].'|^@^|FN:'.$key[1].'|^@^|LN:'.$key[2].'|^@^|DOB:'.$key[3].'|^@^|S:|^@^|OB:'.$key[4].'|^@^|RB:'.'|^@^|PN:'.$key[5].'|^@^|PED:'.$key[6].'|^@^|PIC:'.$key[7].'|^@^|VN:'.$key[8].'|^@^|VED:'.$key[9].'|^@^|VIC:'.$key[10]);
			}
		}
		else{
			foreach (array_chunk($adult, 11) as $key) {
				array_push($parsed_passengers,'T:A|^@^|TL:'.$key[0].'|^@^|FN:'.$key[1].'|^@^|LN:'.$key[2].'|^@^|DOB:'.$key[3].'|^@^|S:|^@^|OB:'.$key[4].'|^@^|RB:'.'|^@^|PN:'.$key[5].'|^@^|PED:'.$key[6].'|^@^|PIC:'.$key[7].'|^@^|VN:'.$key[8].'|^@^|VED:'.$key[9].'|^@^|VIC:'.$key[10]);
			}
		}

		if (count($children) % 12 == 0) {
			if(count($children)/$total_child == 8) {
			// if(count($children)/$total_child == 8 && $form_data['returnbaggages'] == 'null') {
				foreach (array_chunk($children, 8) as $key) {
					array_push($parsed_passengers,'T:C|^@^|TL:'.$key[0].'|^@^|FN:'.$key[1].'|^@^|LN:'.$key[2].'|^@^|DOB:'.$key[3].'|^@^|S:|^@^|OB:'.$key[4].'|^@^|RB:'.'|^@^|PN:'.$key[5].'|^@^|PED:'.$key[6].'|^@^|PIC:'.$key[7].'|^@^|VN:'.'|^@^|VED:'.'|^@^|VIC:');
				}
				// echo '8';

			} else {
				foreach (array_chunk($children, 12) as $key) {
					array_push($parsed_passengers,'T:C|^@^|TL:'.$key[0].'|^@^|FN:'.$key[1].'|^@^|LN:'.$key[2].'|^@^|DOB:'.$key[3].'|^@^|S:|^@^|OB:'.$key[4].'|^@^|RB:'.$key[5].'|^@^|PN:'.$key[6].'|^@^|PED:'.$key[7].'|^@^|PIC:'.$key[8].'|^@^|VN:'.$key[9].'|^@^|VED:'.$key[10].'|^@^|VIC:'.$key[11]);
				}
			}

		}elseif (count($children) % 9 == 0) {
			foreach (array_chunk($children, 9) as $key) {
				array_push($parsed_passengers,'T:C|^@^|TL:'.$key[0].'|^@^|FN:'.$key[1].'|^@^|LN:'.$key[2].'|^@^|DOB:'.$key[3].'|^@^|S:|^@^|OB:'.$key[4].'|^@^|RB:'.$key[5].'|^@^|PN:'.$key[6].'|^@^|PED:'.$key[7].'|^@^|PIC:'.$key[8].'|^@^|VN:'.'|^@^|VED:'.'|^@^|VIC:');
			}
		}elseif (count($children) % 8== 0) {
			foreach (array_chunk($children, 8) as $key) {
				array_push($parsed_passengers,'T:C|^@^|TL:'.$key[0].'|^@^|FN:'.$key[1].'|^@^|LN:'.$key[2].'|^@^|DOB:'.$key[3].'|^@^|S:|^@^|OB:'.$key[4].'|^@^|RB:'.'|^@^|PN:'.$key[5].'|^@^|PED:'.$key[6].'|^@^|PIC:'.$key[7].'|^@^|VN:'.$key[8].'|^@^|VED:'.$key[9].'|^@^|VIC:'.$key[10]);
			}

			// echo '8';
		}else{
			// foreach (array_chunk($children, 9) as $key) {
			// 	array_push($parsed_passengers,'T:C|^@^|TL:'.$key[0].'|^@^|FN:'.$key[1].'|^@^|LN:'.$key[2].'|^@^|DOB:'.$key[3].'|^@^|S:|^@^|OB:'.$key[4].'|^@^|RB:'.'|^@^|PN:'.$key[5].'|^@^|PED:'.$key[6].'|^@^|PIC:'.$key[7].'|^@^|VN:'.$key[8].'|^@^|VED:'.$key[9].'|^@^|VIC:'.$key[10]);
			// }
			foreach (array_chunk($children, 11) as $key) {
				array_push($parsed_passengers,'T:C|^@^|TL:'.$key[0].'|^@^|FN:'.$key[1].'|^@^|LN:'.$key[2].'|^@^|DOB:'.$key[3].'|^@^|S:|^@^|OB:'.$key[4].'|^@^|RB:'.'|^@^|PN:'.$key[5].'|^@^|PED:'.$key[6].'|^@^|PIC:'.$key[7].'|^@^|VN:'.$key[8].'|^@^|VED:'.$key[9].'|^@^|VIC:'.$key[10]);
			}
		}

		if (count($infant) >= 1) {
			if (count($infant) % 7 == 0) { 
				foreach (array_chunk($infant, 7) as $key) {
					array_push($parsed_passengers,'T:I|^@^|TL:'.$key[0].'|^@^|FN:'.$key[1].'|^@^|LN:'.$key[2].'|^@^|DOB:'.$key[3].'|^@^|S:|^@^|OB:0|^@^|RB:0'.'|^@^|PN:'.$key[4].'|^@^|PED:'.$key[5].'|^@^|PIC:'.$key[6].'|^@^|VN:'.'|^@^|VED:'.'|^@^|VIC:');
				}
			} else {
				foreach (array_chunk($infant, 10) as $key) {
					array_push($parsed_passengers,'T:I|^@^|TL:'.$key[0].'|^@^|FN:'.$key[1].'|^@^|LN:'.$key[2].'|^@^|DOB:'.$key[3].'|^@^|S:|^@^|OB:0|^@^|RB:0'.'|^@^|PN:'.$key[4].'|^@^|PED:'.$key[5].'|^@^|PIC:'.$key[6].'|^@^|VN:'.$key[7].'|^@^|VED:'.$key[8].'|^@^|VIC:'.$key[9]);
				}
			}	
		}

		return implode('|*|', $parsed_passengers);

	}

	public function get_parsed_passengersScoot($form_data)
	{
		$senior = array();
		$adult = array();
		$children = array();
		$infant = array();
		foreach ($form_data as $key => $value) {
			if (substr($key, 0, 2) == 's_') {
				array_push($senior, $value);
			}elseif (substr($key, 0, 2) == 'a_') {
				array_push($adult, $value);
			}elseif (substr($key, 0, 2) == 'c_') {
				array_push($children, $value);
			}elseif (substr($key, 0, 2) == 'i_'){
				array_push($infant, $value);
			}
		}

		// $chosen = json_decode($form_data['choose_flights']);
		// $total_adult  = (int)($chosen[0]->choosen[6]->Adult);
		// $total_child  = (int)($chosen[0]->choosen[6]->Children);
		// $total_infant = (int)($chosen[0]->choosen[6]->Infant);
		// $total_senior = (int)($chosen[0]->choosen[6]->Senior);

		// echo '<pre>';
		// 	print_r(count($senior));
		// echo '</pre>';
		// echo '<pre>';
		// 	print_r(count($adult));
		// echo '</pre>';
		// echo '<pre>';
		// 	print_r(count($children));
		// echo '</pre>';
		// echo '<pre>';
		// 	print_r(count($infant));
		// echo '</pre>';


		$parsed_passengers = array();	
		if (count($senior) % 15 == 0) {
			foreach (array_chunk($senior, 15) as $key) {
				array_push($parsed_passengers,'T:S|^@^|TL:'.$key[0].'|^@^|FN:'.$key[1].'|^@^|LN:'.$key[2].'|^@^|DOB:'.$key[3].'|^@^|S:'.$key[4].'|^@^|OB:'.$key[5].'|^@^|RB:'.$key[6].'|^@^|GEN:'.$key[7].'|^@^|PN:'.$key[8].'|^@^|PED:'.$key[9].'|^@^|PIC:'.$key[10].'|^@^|RC:'.$key[11].'|^@^|VN:'.$key[12].'|^@^|VED:'.$key[13].'|^@^|VIC:'.$key[14]);
			}
		}else{
			foreach (array_chunk($senior, 14) as $key) {
				array_push($parsed_passengers,'T:S|^@^|TL:'.$key[0].'|^@^|FN:'.$key[1].'|^@^|LN:'.$key[2].'|^@^|DOB:'.$key[3].'|^@^|S:'.$key[4].'|^@^|OB:'.$key[5].'|^@^|RB:'.'|^@^|GEN:'.$key[6].'|^@^|PN:'.$key[7].'|^@^|PED:'.$key[8].'|^@^|PIC:'.$key[9].'|^@^|RC:'.$key[10].'|^@^|VN:'.$key[11].'|^@^|VED:'.$key[12].'|^@^|VIC:'.$key[13]);
			}
		}

		if (count($adult) % 14 == 0) {
			foreach (array_chunk($adult, 14) as $key) {
				array_push($parsed_passengers,'T:A|^@^|TL:'.$key[0].'|^@^|FN:'.$key[1].'|^@^|LN:'.$key[2].'|^@^|DOB:'.$key[3].'|^@^|S:|^@^|OB:'.$key[4].'|^@^|RB:'.$key[5].'|^@^|GEN:'.$key[6].'|^@^|PN:'.$key[7].'|^@^|PED:'.$key[8].'|^@^|PIC:'.$key[9].'|^@^|RC:'.$key[10].'|^@^|VN:'.$key[11].'|^@^|VED:'.$key[12].'|^@^|VIC:'.$key[13]);
			}
		}
		elseif (count($adult) % 11 == 0) {
			foreach (array_chunk($adult, 11) as $key) {
				array_push($parsed_passengers,'T:A|^@^|TL:'.$key[0].'|^@^|FN:'.$key[1].'|^@^|LN:'.$key[2].'|^@^|DOB:'.$key[3].'|^@^|S:|^@^|OB:'.$key[4].'|^@^|RB:'.$key[5].'|^@^|GEN:'.$key[6].'|^@^|PN:'.$key[7].'|^@^|PED:'.$key[8].'|^@^|PIC:'.$key[9].'|^@^|RC:'.$key[10].'|^@^|VN:'.'|^@^|VED:'.'|^@^|VIC:');
			}
		}
		elseif (count($adult) % 10 == 0) {
			foreach (array_chunk($adult, 10) as $key) {
				array_push($parsed_passengers,'T:A|^@^|TL:'.$key[0].'|^@^|FN:'.$key[1].'|^@^|LN:'.$key[2].'|^@^|DOB:'.$key[3].'|^@^|S:|^@^|OB:'.$key[4].'|^@^|RB:'.'|^@^|GEN:'.$key[5].'|^@^|PN:'.$key[6].'|^@^|PED:'.$key[7].'|^@^|PIC:'.$key[8].'|^@^|RC:'.$key[9].'|^@^|VN:'.$key[10].'|^@^|VED:'.$key[11].'|^@^|VIC:'.$key[12]);
			}
		}
		else{
			foreach (array_chunk($adult, 13) as $key) {
				array_push($parsed_passengers,'T:A|^@^|TL:'.$key[0].'|^@^|FN:'.$key[1].'|^@^|LN:'.$key[2].'|^@^|DOB:'.$key[3].'|^@^|S:|^@^|OB:'.$key[4].'|^@^|RB:'.'|^@^|GEN:'.$key[5].'|^@^|PN:'.$key[6].'|^@^|PED:'.$key[7].'|^@^|PIC:'.$key[8].'|^@^|RC:'.$key[9].'|^@^|VN:'.$key[10].'|^@^|VED:'.$key[11].'|^@^|VIC:'.$key[12]);
			}
		}

		if (count($children) % 14 == 0) {
			foreach (array_chunk($children, 14) as $key) {
				array_push($parsed_passengers,'T:C|^@^|TL:'.$key[0].'|^@^|FN:'.$key[1].'|^@^|LN:'.$key[2].'|^@^|DOB:'.$key[3].'|^@^|S:|^@^|OB:'.$key[4].'|^@^|RB:'.$key[5].'|^@^|GEN:'.$key[6].'|^@^|PN:'.$key[7].'|^@^|PED:'.$key[8].'|^@^|PIC:'.$key[9].'|^@^|RC:'.$key[10].'|^@^|VN:'.$key[11].'|^@^|VED:'.$key[12].'|^@^|VIC:'.$key[13]);
			}		
		}elseif (count($children) % 11 == 0) {
			foreach (array_chunk($children, 11) as $key) {
				array_push($parsed_passengers,'T:C|^@^|TL:'.$key[0].'|^@^|FN:'.$key[1].'|^@^|LN:'.$key[2].'|^@^|DOB:'.$key[3].'|^@^|S:|^@^|OB:'.$key[4].'|^@^|RB:'.$key[5].'|^@^|GEN:'.$key[6].'|^@^|PN:'.$key[7].'|^@^|PED:'.$key[8].'|^@^|PIC:'.$key[9].'|^@^|RC:'.$key[10].'|^@^|VN:'.'|^@^|VED:'.'|^@^|VIC:');
			}
		}elseif (count($children) % 10 == 0) {
			foreach (array_chunk($children, 10) as $key) {
				array_push($parsed_passengers,'T:C|^@^|TL:'.$key[0].'|^@^|FN:'.$key[1].'|^@^|LN:'.$key[2].'|^@^|DOB:'.$key[3].'|^@^|S:|^@^|OB:'.$key[4].'|^@^|RB:'.'|^@^|GEN:'.$key[5].'|^@^|PN:'.$key[6].'|^@^|PED:'.$key[7].'|^@^|PIC:'.$key[8].'|^@^|RC:'.$key[9].'|^@^|VN:'.$key[10].'|^@^|VED:'.$key[11].'|^@^|VIC:'.$key[12]);
			}
		}else{
			// foreach (array_chunk($children, 9) as $key) {
			// 	array_push($parsed_passengers,'T:C|^@^|TL:'.$key[0].'|^@^|FN:'.$key[1].'|^@^|LN:'.$key[2].'|^@^|DOB:'.$key[3].'|^@^|S:|^@^|OB:'.$key[4].'|^@^|RB:'.'|^@^|PN:'.$key[5].'|^@^|PED:'.$key[6].'|^@^|PIC:'.$key[7].'|^@^|VN:'.$key[8].'|^@^|VED:'.$key[9].'|^@^|VIC:'.$key[10]);
			// }
			foreach (array_chunk($children, 13) as $key) {
				array_push($parsed_passengers,'T:C|^@^|TL:'.$key[0].'|^@^|FN:'.$key[1].'|^@^|LN:'.$key[2].'|^@^|DOB:'.$key[3].'|^@^|S:|^@^|OB:'.$key[4].'|^@^|RB:'.'|^@^|GEN:'.$key[5].'|^@^|PN:'.$key[6].'|^@^|PED:'.$key[7].'|^@^|PIC:'.$key[8].'|^@^|RC:'.$key[9].'|^@^|VN:'.$key[10].'|^@^|VED:'.$key[11].'|^@^|VIC:'.$key[12]);
			}
		}

		if (count($infant) >= 1) {

			if (count($children) % 9 == 0) { 
				foreach (array_chunk($infant, 9) as $key) {
					array_push($parsed_passengers,'T:I|^@^|TL:'.$key[0].'|^@^|FN:'.$key[1].'|^@^|LN:'.$key[2].'|^@^|DOB:'.$key[3].'|^@^|S:|^@^|OB:0|^@^|RB:0'.'|^@^|GEN:'.$key[4].'|^@^|PN:'.$key[5].'|^@^|PED:'.$key[6].'|^@^|PIC:'.$key[7].'|^@^|RC:'.$key[8].'|^@^|VN:'.'|^@^|VED:'.'|^@^|VIC:');
				}
			} else {
				foreach (array_chunk($infant, 12) as $key) {
					array_push($parsed_passengers,'T:I|^@^|TL:'.$key[0].'|^@^|FN:'.$key[1].'|^@^|LN:'.$key[2].'|^@^|DOB:'.$key[3].'|^@^|S:|^@^|OB:0|^@^|RB:0'.'|^@^|GEN:'.$key[4].'|^@^|PN:'.$key[5].'|^@^|PED:'.$key[6].'|^@^|PIC:'.$key[7].'|^@^|RC:'.$key[8].'|^@^|VN:'.$key[9].'|^@^|VED:'.$key[10].'|^@^|VIC:'.$key[11]);
				}
			}
		}

		return implode('|*|', $parsed_passengers);

	}

	public function ui_passengers_details($form_data,$baggages)
	{
		$senior = array();
		$adult = array();
		$children = array();
		$infant = array();
		foreach ($form_data as $key => $value) {
			if (substr($key, 0, 2) == 's_') {
				array_push($senior, $value);
			}elseif (substr($key, 0, 2) == 'a_') {
				array_push($adult, $value);
			}elseif (substr($key, 0, 2) == 'c_') {
				array_push($children, $value);
			}elseif (substr($key, 0, 2) == 'i_'){
				array_push($infant, $value);
			}
		}
		// $title = array('','Mr','Mrs','Miss','Mstr');

		if($senior || $adult) {
			$title = array('','Mr','Ms','Ms','Mstr');
		} else {
			$title = array('','Mr','Ms','Miss','Mstr');
		}

		$parsed_passengers_details = array();
		if (count($senior) % 7 == 0) {
			foreach (array_chunk($senior, 7) as $key) {
				array_push($parsed_passengers_details, array(
						'T' => 'S',
						'name' => $title[$key[0]].' '.$key[1].' '.$key[2],
						'bdate' => $key[3],
						'SID' => $key[4],
						'OB' => $baggages['OB'][$key[5]],
						'RB' => $baggages['RB'][$key[6]]
					));
			}
		}else{
			foreach (array_chunk($senior, 6) as $key) {
				array_push($parsed_passengers_details,array(
						'T' => 'S',
						'Name' => $title[$key[0]].' '.$key[1].' '.$key[2],
						'Bdate' => $key[3],
						'SID' => $key[4],
						'OB' => $baggages['OB'][$key[5]]
					));
			}
		}
		// if (count($adult) % 6 == 0) {
		if (count($adult) % 6 == 0 && $form_data['returnbaggages'] != 'null') {
			foreach (array_chunk($adult, 6) as $key) {
				array_push($parsed_passengers_details,array(
						'T' => 'A',	
						'name' => $title[$key[0]].' '.$key[1].' '.$key[2],
						'bdate' => $key[3],
						'OB' => $baggages['OB'][$key[4]],
						'RB' => $baggages['RB'][$key[5]]
					));
				// var_dump($key);exit();
			}
		}
		else{
			foreach (array_chunk($adult, 5) as $key) {
				array_push($parsed_passengers_details,array(
						'T' => 'A',
						'name' => $title[$key[0]].' '.$key[1].' '.$key[2],
						'bdate' => $key[3],
						'OB' => $baggages['OB'][$key[4]]
					));
			}
		}

		// if (count($children) % 6 == 0) {
		if (count($children) % 6 == 0 && $form_data['returnbaggages'] != 'null') {
			foreach (array_chunk($children, 6) as $key) {
				array_push($parsed_passengers_details,array(
						'T' => 'C',
						'name' => $title[$key[0]].' '.$key[1].' '.$key[2],
						'bdate' => $key[3],
						'OB' => $baggages['OB'][$key[4]],
						'RB' => $baggages['RB'][$key[5]]
					));
			}		

		}else{
			foreach (array_chunk($children, 5) as $key) {
				array_push($parsed_passengers_details,array(
						'T' => 'C',
						'name' => $title[$key[0]].' '.$key[1].' '.$key[2],
						'bdate' => $key[3],
						'OB' => $baggages['OB'][$key[4]]
					));
			}
		}

		if (count($infant) >= 1) {
			foreach (array_chunk($infant, 4) as $key) {
				array_push($parsed_passengers_details,array(
						'T' => 'I',
						'name' => $title[$key[0]].' '.$key[1].' '.$key[2],
						'bdate' => $key[3]
					));
			}
		}

		return $parsed_passengers_details;
	}

	public function ui_passengers_detailsByaheko($form_data,$baggages)
	{
		$senior = array();
		$adult = array();
		$children = array();
		$infant = array();
		foreach ($form_data as $key => $value) {
			if (substr($key, 0, 2) == 's_') {
				array_push($senior, $value);
			}elseif (substr($key, 0, 2) == 'a_') {
				array_push($adult, $value);
			}elseif (substr($key, 0, 2) == 'c_') {
				array_push($children, $value);
			}elseif (substr($key, 0, 2) == 'i_'){
				array_push($infant, $value);
			}
		}
		// $title = array('','Mr','Mrs','Miss','Mstr');
		
		if($senior || $adult) {
			$title = array('','Mr','Ms','Ms','Mstr');
		} else {
			$title = array('','Mr','Ms','Miss','Mstr');
		}

		$parsed_passengers_details = array();
		if (count($senior) % 11 == 0) {
			foreach (array_chunk($senior, 11) as $key) {
				array_push($parsed_passengers_details, array(
						'T' => 'S',
						'name' => $title[$key[0]].' '.$key[1].' '.$key[2],
						'bdate' => $key[3],
						'SID' => $key[4],
						'OB' => $baggages['OB'][$key[5]],
						'RB' => $baggages['RB'][$key[6]],
						'PN' => $key[7],
						'PED' => $key[8],
						'PIC' => $key[9],
						'NAT' => $key[10]
					));
			}
		}else{
			foreach (array_chunk($senior, 10) as $key) {
				array_push($parsed_passengers_details,array(
						'T' => 'S',
						'Name' => $title[$key[0]].' '.$key[1].' '.$key[2],
						'Bdate' => $key[3],
						'SID' => $key[4],
						'OB' => $baggages['OB'][$key[5]],
						'PN' => $key[6],
						'PED' => $key[7],
						'PIC' => $key[8],
						'NAT' => $key[9]
					));
			}
		}
		if (count($adult) % 10 == 0) {
			foreach (array_chunk($adult, 10) as $key) {
				array_push($parsed_passengers_details,array(
						'T' => 'A',	
						'name' => $title[$key[0]].' '.$key[1].' '.$key[2],
						'bdate' => $key[3],
						'OB' => $baggages['OB'][$key[4]],
						'RB' => $baggages['RB'][$key[5]],
						'PN' => $key[6],
						'PED' => $key[7],
						'PIC' => $key[8],
						'NAT' => $key[9]
					));
				// var_dump($key);exit();
			}
		}
		else{
			foreach (array_chunk($adult, 9) as $key) {
				array_push($parsed_passengers_details,array(
						'T' => 'A',
						'name' => $title[$key[0]].' '.$key[1].' '.$key[2],
						'bdate' => $key[3],
						'OB' => $baggages['OB'][$key[4]],
						'PN' => $key[5],
						'PED' => $key[6],
						'PIC' => $key[7],
						'NAT' => $key[8]
					));
			}
		}

		if (count($children) % 10 == 0) {
			foreach (array_chunk($children, 10) as $key) {
				array_push($parsed_passengers_details,array(
						'T' => 'C',
						'name' => $title[$key[0]].' '.$key[1].' '.$key[2],
						'bdate' => $key[3],
						'OB' => $baggages['OB'][$key[4]],
						'RB' => $baggages['RB'][$key[5]],
						'PN' => $key[6],
						'PED' => $key[7],
						'PIC' => $key[8],
						'NAT' => $key[9]
					));
			}		

		}else{
			foreach (array_chunk($children, 9) as $key) {
				array_push($parsed_passengers_details,array(
						'T' => 'C',
						'name' => $title[$key[0]].' '.$key[1].' '.$key[2],
						'bdate' => $key[3],
						'OB' => $baggages['OB'][$key[4]],
						'PN' => $key[5],
						'PED' => $key[6],
						'PIC' => $key[7],
						'NAT' => $key[8]
					));
			}
		}

		if (count($infant) >= 1) {
			foreach (array_chunk($infant, 8) as $key) {
				array_push($parsed_passengers_details,array(
						'T' => 'I',
						'name' => $title[$key[0]].' '.$key[1].' '.$key[2],
						'bdate' => $key[3],
						'PN' => $key[4],
						'PED' => $key[5],
						'PIC' => $key[6],
						'NAT' => $key[7]
					));
			}
		}

		return $parsed_passengers_details;
	}

	public function ui_passengers_detailsAmadeus($form_data,$baggages)
	{
		$senior = array();
		$adult = array();
		$children = array();
		$infant = array();
		foreach ($form_data as $key => $value) {
			if (substr($key, 0, 2) == 's_') {
				array_push($senior, $value);
			}elseif (substr($key, 0, 2) == 'a_') {
				array_push($adult, $value);
			}elseif (substr($key, 0, 2) == 'c_') {
				array_push($children, $value);
			}elseif (substr($key, 0, 2) == 'i_'){
				array_push($infant, $value);
			}
		}

		$chosen = json_decode($form_data['choose_flights']);
		$total_adult  = (int)($chosen[0]->choosen[6]->Adult);
		$total_child  = (int)($chosen[0]->choosen[6]->Children);
		$total_infant = (int)($chosen[0]->choosen[6]->Infant);
		$total_senior = (int)($chosen[0]->choosen[6]->Senior);

		if($senior || $adult) {
			$title = array('','Mr','Ms','Ms','Mstr');
		} else {
			$title = array('','Mr','Ms','Miss','Mstr');
		}

		$parsed_passengers_details = array();
		if (count($senior) % 13 == 0) {
			foreach (array_chunk($senior, 13) as $key) {
				array_push($parsed_passengers_details, array(
						'T' => 'S',
						'name' => $title[$key[0]].' '.$key[1].' '.$key[2],
						'bdate' => $key[3],
						'SID' => $key[4],
						'OB' => $baggages['OB'][$key[5]],
						'RB' => $baggages['RB'][$key[6]],
						'PN' => $key[7],
						'PED' => $key[8],
						'PIC' => $key[9],
						'VN' => $key[10],
						'VED' => $key[11],
						'VIC' => $key[12]
					));
			}
		}else{
			foreach (array_chunk($senior, 12) as $key) {
				array_push($parsed_passengers_details,array(
						'T' => 'S',
						'Name' => $title[$key[0]].' '.$key[1].' '.$key[2],
						'Bdate' => $key[3],
						'SID' => $key[4],
						'OB' => $baggages['OB'][$key[5]],
						'PN' => $key[6],
						'PED' => $key[7],
						'PIC' => $key[8],
						'VN' => $key[9],
						'VED' => $key[10],
						'VIC' => $key[11]
					));
			}
		}
		if (count($adult) % 12 == 0) {
			if(count($adult)/$total_adult == 8) {
			// if(count($adult)/$total_adult == 8 && $form_data['returnbaggages'] == 'null') {
				foreach (array_chunk($adult, 8) as $key) {
					array_push($parsed_passengers_details,array(
							'T' => 'A',
							'name' => $title[$key[0]].' '.$key[1].' '.$key[2],
							'bdate' => $key[3],
							'OB' => $baggages['OB'][$key[4]],
							'PN' => $key[5],
							'PED' => $key[6],
							'PIC' => $key[7],
							'VN' => $key[8],
							'VED' => $key[9],
							'VIC' => $key[10]
						));
				}
			} else {
				foreach (array_chunk($adult, 12) as $key) {
					array_push($parsed_passengers_details,array(
							'T' => 'A',	
							'name' => $title[$key[0]].' '.$key[1].' '.$key[2],
							'bdate' => $key[3],
							'OB' => $baggages['OB'][$key[4]],
							'RB' => $baggages['RB'][$key[5]],
							'PN' => $key[6],
							'PED' => $key[7],
							'PIC' => $key[8],
							'VN' => $key[9],
							'VED' => $key[10],
							'VIC' => $key[11]
						));
					// var_dump($key);exit();
				}
			}

		} elseif (count($adult) % 9 == 0) {
			foreach (array_chunk($adult, 9) as $key) {
				array_push($parsed_passengers_details,array(
						'T' => 'A',	
						'name' => $title[$key[0]].' '.$key[1].' '.$key[2],
						'bdate' => $key[3],
						'OB' => $baggages['OB'][$key[4]],
						'RB' => $baggages['RB'][$key[5]],
						'PN' => $key[6],
						'PED' => $key[7],
						'PIC' => $key[8],
						'VN' => $key[9],
						'VED' => $key[10],
						'VIC' => $key[11]
					));
				// var_dump($key);exit();
			}
		} elseif (count($adult) % 8 == 0) {
			foreach (array_chunk($adult, 8) as $key) {
				array_push($parsed_passengers_details,array(
						'T' => 'A',
						'name' => $title[$key[0]].' '.$key[1].' '.$key[2],
						'bdate' => $key[3],
						'OB' => $baggages['OB'][$key[4]],
						'PN' => $key[5],
						'PED' => $key[6],
						'PIC' => $key[7],
						'VN' => $key[8],
						'VED' => $key[9],
						'VIC' => $key[10]
					));
				// var_dump($key);exit();
			}
		} else{
			foreach (array_chunk($adult, 11) as $key) {
				array_push($parsed_passengers_details,array(
						'T' => 'A',
						'name' => $title[$key[0]].' '.$key[1].' '.$key[2],
						'bdate' => $key[3],
						'OB' => $baggages['OB'][$key[4]],
						'PN' => $key[5],
						'PED' => $key[6],
						'PIC' => $key[7],
						'VN' => $key[8],
						'VED' => $key[9],
						'VIC' => $key[10]
					));
			}
		}

		if (count($children) % 12 == 0) {
			if(count($children)/$total_child == 8) {
			// if(count($children)/$total_child == 8 && $form_data['returnbaggages'] == 'null') {
				foreach (array_chunk($children, 8) as $key) {
					array_push($parsed_passengers_details,array(
							'T' => 'C',
							'name' => $title[$key[0]].' '.$key[1].' '.$key[2],
							'bdate' => $key[3],
							'OB' => $baggages['OB'][$key[4]],
							'PN' => $key[5],
							'PED' => $key[6],
							'PIC' => $key[7],
							'VN' => $key[8],
							'VED' => $key[9],
							'VIC' => $key[10]
						));
				}
			} else {
				foreach (array_chunk($children, 12) as $key) {
					array_push($parsed_passengers_details,array(
							'T' => 'C',
							'name' => $title[$key[0]].' '.$key[1].' '.$key[2],
							'bdate' => $key[3],
							'OB' => $baggages['OB'][$key[4]],
							'RB' => $baggages['RB'][$key[5]],
							'PN' => $key[6],
							'PED' => $key[7],
							'PIC' => $key[8],
							'VN' => $key[9],
							'VED' => $key[10],
							'VIC' => $key[11]
						));
				}	
			}
	

		} elseif (count($children) % 9 == 0) {
			foreach (array_chunk($children, 9) as $key) {
				array_push($parsed_passengers_details,array(
						'T' => 'C',
						'name' => $title[$key[0]].' '.$key[1].' '.$key[2],
						'bdate' => $key[3],
						'OB' => $baggages['OB'][$key[4]],
						'RB' => $baggages['RB'][$key[5]],
						'PN' => $key[6],
						'PED' => $key[7],
						'PIC' => $key[8],
						'VN' => $key[9],
						'VED' => $key[10],
						'VIC' => $key[11]
					));
			}		
		} elseif (count($children) % 8 == 0) {
			foreach (array_chunk($children, 8) as $key) {
				array_push($parsed_passengers_details,array(
						'T' => 'C',
						'name' => $title[$key[0]].' '.$key[1].' '.$key[2],
						'bdate' => $key[3],
						'OB' => $baggages['OB'][$key[4]],
						'PN' => $key[5],
						'PED' => $key[6],
						'PIC' => $key[7],
						'VN' => $key[8],
						'VED' => $key[9],
						'VIC' => $key[10]
					));
				// var_dump($key);exit();
			}
		} else{
			foreach (array_chunk($children, 11) as $key) {
				array_push($parsed_passengers_details,array(
						'T' => 'C',
						'name' => $title[$key[0]].' '.$key[1].' '.$key[2],
						'bdate' => $key[3],
						'OB' => $baggages['OB'][$key[4]],
						'PN' => $key[5],
						'PED' => $key[6],
						'PIC' => $key[7],
						'VN' => $key[8],
						'VED' => $key[9],
						'VIC' => $key[10]
					));
			}
		}

		if (count($infant) >= 1) {
			if (count($infant) % 7 == 0) {
				foreach (array_chunk($infant, 7) as $key) {
					array_push($parsed_passengers_details,array(
							'T' => 'I',
							'name' => $title[$key[0]].' '.$key[1].' '.$key[2],
							'bdate' => $key[3],
							'PN' => $key[4],
							'PED' => $key[5],
							'PIC' => $key[6],
							'VN' => "",
							'VED' => "",
							'VIC' => "",
						));
				}
			} else {
				foreach (array_chunk($infant, 10) as $key) {
					array_push($parsed_passengers_details,array(
							'T' => 'I',
							'name' => $title[$key[0]].' '.$key[1].' '.$key[2],
							'bdate' => $key[3],
							'PN' => $key[4],
							'PED' => $key[5],
							'PIC' => $key[6],
							'VN' => $key[7],
							'VED' => $key[8],
							'VIC' => $key[9]
						));
				}
			}
		}

		return $parsed_passengers_details;
	}

	public function ui_passengers_detailsScoot($form_data,$baggages)
	{
		$senior = array();
		$adult = array();
		$children = array();
		$infant = array();
		foreach ($form_data as $key => $value) {
			if (substr($key, 0, 2) == 's_') {
				array_push($senior, $value);
			}elseif (substr($key, 0, 2) == 'a_') {
				array_push($adult, $value);
			}elseif (substr($key, 0, 2) == 'c_') {
				array_push($children, $value);
			}elseif (substr($key, 0, 2) == 'i_'){
				array_push($infant, $value);
			}
		}
		// $title = array('','Mr','Mrs','Miss','Mstr');

		if($senior || $adult) {
			$title = array('','Mr','Ms','Ms','Mstr');
		} else {
			$title = array('','Mr','Ms','Miss','Mstr');
		}

		$parsed_passengers_details = array();
		if (count($senior) % 15 == 0) {
			foreach (array_chunk($senior, 15) as $key) {
				array_push($parsed_passengers_details, array(
						'T' => 'S',
						'name' => $title[$key[0]].' '.$key[1].' '.$key[2],
						'bdate' => $key[3],
						'SID' => $key[4],
						'OB' => $baggages['OB'][$key[5]],
						'RB' => $baggages['RB'][$key[6]],
						'GEN' => $key[7],
						'PN' => $key[8],
						'PED' => $key[9],
						'PIC' => $key[10],
						'RC' => $key[11],
						'VN' => $key[12],
						'VED' => $key[13],
						'VIC' => $key[14]
					));
			}
		}else{
			foreach (array_chunk($senior, 14) as $key) {
				array_push($parsed_passengers_details,array(
						'T' => 'S',
						'Name' => $title[$key[0]].' '.$key[1].' '.$key[2],
						'Bdate' => $key[3],
						'SID' => $key[4],
						'OB' => $baggages['OB'][$key[5]],
						'GEN' => $key[6],
						'PN' => $key[7],
						'PED' => $key[8],
						'PIC' => $key[9],
						'RC' => $key[10],
						'VN' => $key[11],
						'VED' => $key[12],
						'VIC' => $key[13]
					));
			}
		}
		if (count($adult) % 14 == 0) {
			foreach (array_chunk($adult, 14) as $key) {
				array_push($parsed_passengers_details,array(
						'T' => 'A',	
						'name' => $title[$key[0]].' '.$key[1].' '.$key[2],
						'bdate' => $key[3],
						'OB' => $baggages['OB'][$key[4]],
						'RB' => $baggages['RB'][$key[5]],
						'GEN' => $key[6],
						'PN' => $key[7],
						'PED' => $key[8],
						'PIC' => $key[9],
						'RC' => $key[10],
						'VN' => $key[11],
						'VED' => $key[12],
						'VIC' => $key[13]
					));
				// var_dump($key);exit();
			}
		} elseif (count($adult) % 11 == 0) {
			foreach (array_chunk($adult, 11) as $key) {
				array_push($parsed_passengers_details,array(
						'T' => 'A',	
						'name' => $title[$key[0]].' '.$key[1].' '.$key[2],
						'bdate' => $key[3],
						'OB' => $baggages['OB'][$key[4]],
						'RB' => $baggages['RB'][$key[5]],
						'GEN' => $key[6],
						'PN' => $key[7],
						'PED' => $key[8],
						'PIC' => $key[9],
						'RC' => $key[10],
						'VN' => $key[11],
						'VED' => $key[12],
						'VIC' => $key[13]
					));
				// var_dump($key);exit();
			}
		} elseif (count($adult) % 10 == 0) {
			foreach (array_chunk($adult, 10) as $key) {
				array_push($parsed_passengers_details,array(
						'T' => 'A',
						'name' => $title[$key[0]].' '.$key[1].' '.$key[2],
						'bdate' => $key[3],
						'OB' => $baggages['OB'][$key[4]],
						'GEN' => $key[5],
						'PN' => $key[6],
						'PED' => $key[7],
						'PIC' => $key[8],
						'RC' => $key[9],
						'VN' => $key[10],
						'VED' => $key[11],
						'VIC' => $key[12]
					));
				// var_dump($key);exit();
			}
		} else{
			foreach (array_chunk($adult, 13) as $key) {
				array_push($parsed_passengers_details,array(
						'T' => 'A',
						'name' => $title[$key[0]].' '.$key[1].' '.$key[2],
						'bdate' => $key[3],
						'OB' => $baggages['OB'][$key[4]],
						'GEN' => $key[5],
						'PN' => $key[6],
						'PED' => $key[7],
						'PIC' => $key[8],
						'RC' => $key[9],
						'VN' => $key[10],
						'VED' => $key[11],
						'VIC' => $key[12]
					));
			}
		}

		if (count($children) % 14 == 0) {
			foreach (array_chunk($children, 14) as $key) {
				array_push($parsed_passengers_details,array(
						'T' => 'C',
						'name' => $title[$key[0]].' '.$key[1].' '.$key[2],
						'bdate' => $key[3],
						'OB' => $baggages['OB'][$key[4]],
						'RB' => $baggages['RB'][$key[5]],
						'GEN' => $key[6],
						'PN' => $key[7],
						'PED' => $key[8],
						'PIC' => $key[9],
						'RC' => $key[10],
						'VN' => $key[11],
						'VED' => $key[12],
						'VIC' => $key[13]
					));
			}		

		} elseif (count($children) % 11 == 0) {
			foreach (array_chunk($children, 11) as $key) {
				array_push($parsed_passengers_details,array(
						'T' => 'C',
						'name' => $title[$key[0]].' '.$key[1].' '.$key[2],
						'bdate' => $key[3],
						'OB' => $baggages['OB'][$key[4]],
						'RB' => $baggages['RB'][$key[5]],
						'GEN' => $key[6],
						'PN' => $key[7],
						'PED' => $key[8],
						'PIC' => $key[9],
						'RC' => $key[10],
						'VN' => $key[11],
						'VED' => $key[12],
						'VIC' => $key[13]
					));
			}		

		} elseif (count($children) % 10 == 0) {
			foreach (array_chunk($children, 10) as $key) {
				array_push($parsed_passengers_details,array(
						'T' => 'C',
						'name' => $title[$key[0]].' '.$key[1].' '.$key[2],
						'bdate' => $key[3],
						'OB' => $baggages['OB'][$key[4]],
						'GEN' => $key[5],
						'PN' => $key[6],
						'PED' => $key[7],
						'PIC' => $key[8],
						'RC' => $key[9],
						'VN' => $key[10],
						'VED' => $key[11],
						'VIC' => $key[12]
					));
			}		

		} else{
			foreach (array_chunk($children, 13) as $key) {
				array_push($parsed_passengers_details,array(
						'T' => 'C',
						'name' => $title[$key[0]].' '.$key[1].' '.$key[2],
						'bdate' => $key[3],
						'OB' => $baggages['OB'][$key[4]],
						'GEN' => $key[5],
						'PN' => $key[6],
						'PED' => $key[7],
						'PIC' => $key[8],
						'RC' => $key[9],
						'VN' => $key[10],
						'VED' => $key[11],
						'VIC' => $key[12]
					));
			}
		}

		if (count($infant) >= 1) {

			if (count($infant) % 9 == 0) {
				foreach (array_chunk($infant, 9) as $key) {
					array_push($parsed_passengers_details,array(
							'T' => 'I',
							'name' => $title[$key[0]].' '.$key[1].' '.$key[2],
							'bdate' => $key[3],
							'GEN' => $key[4],
							'PN' => $key[5],
							'PED' => $key[6],
							'PIC' => $key[7],
							'RC' => $key[8],
							'VN' => "",
							'VED' => "",
							'VIC' => ""
						));
				}
			} else {
				foreach (array_chunk($infant, 12) as $key) {
					array_push($parsed_passengers_details,array(
							'T' => 'I',
							'name' => $title[$key[0]].' '.$key[1].' '.$key[2],
							'bdate' => $key[3],
							'GEN' => $key[4],
							'PN' => $key[5],
							'PED' => $key[6],
							'PIC' => $key[7],
							'RC' => $key[8],
							'VN' => $key[9],
							'VED' => $key[10],
							'VIC' => $key[11]
						));
				}
			}

		}

		return $parsed_passengers_details;
	}


	public function get_parsed_passportuploads($form_data)
	{

		$uploadcount = $form_data['uploadcount'];

		$parsed_uploads = array();
		$x=0;
		while ($x < $uploadcount) {

			array_push($parsed_uploads,$form_data['passportImg'.$x]);

			$x++;
		}

		return implode('|^@^|', $parsed_uploads);

	}

	public function get_parsed_visauploads($form_data)
	{

		$uploadcount = $form_data['uploadcount'];

		$parsed_uploads = array();
		$x=0;
		while ($x < $uploadcount) {

			array_push($parsed_uploads,$form_data['visaImg'.$x]);

			$x++;
		}

		return implode('|^@^|', $parsed_uploads);

	}

	public function get_parsed_rttuploads($form_data)
	{

		$uploadcount = $form_data['uploadcount'];

		$parsed_uploads = array();
		$x=0;
		while ($x < $uploadcount) {

			array_push($parsed_uploads,$form_data['rttImg'.$x]);

			$x++;
		}

		return implode('|^@^|', $parsed_uploads);

	}


} 

