<?php

include 'admin/connect.php';
$conn = OpenCon();
$menu_item = "12";
$title = "Intern Applications";

$sql = "SELECT distinct Details FROM LookupHeadings WHERE Section='Intern Applications' ";
		$result = mysqli_query($conn, $sql);
		$headings = mysqli_fetch_assoc($result);

 ?>
<?php require_once("admin/header.php"); ?>
        <?php require_once("menu.php"); ?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3><?php echo $_SESSION['headingType'] . ' - ' . $title; ?></h3>
                            
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="logout.php">Logout</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>


                <!-- // Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header alert alert-primary alert-dismissible fade show">
								<?php echo @$headings['Details']; ?>
                                    
                                </div>
                                <div class="card-content">
								<?php if(@$message){ ?>	
								<div class="alert alert-success" role="alert"><?php echo @$message; ?></div>
								<?php } ?>
								
								
								
                                    <div class="card-body">
									
									
                                        
                                            <div class="row">
											
									<form class="form" method="post" action="">		
									<div class="col-md-3 col-3" style="float:left;">
									<div class="form-group">
										<label for="Location">Location</label>
										<fieldset class="form-group">
											<select class="choices form-select" id="Location" name="Location">
												<option></option>
												<option value="1" <?php if(@$_POST['Location'] == "1"){ echo "selected='selected'";} ?>>Gauteng</option>
												<option value="2" <?php if(@$_POST['Location'] == "2"){ echo "selected='selected'";} ?>>Free State</option>
												<option value="3" <?php if(@$_POST['Location'] == "3"){ echo "selected='selected'";} ?>>Eastern Cape</option>
												<option value="4" <?php if(@$_POST['Location'] == "4"){ echo "selected='selected'";} ?>>KwaZulu-Natal</option>
												<option value="5" <?php if(@$_POST['Location'] == "5"){ echo "selected='selected'";} ?>>Limpopo</option>
												<option value="6" <?php if(@$_POST['Location'] == "6"){ echo "selected='selected'";} ?>>Mpumalanga</option>
												<option value="7" <?php if(@$_POST['Location'] == "7"){ echo "selected='selected'";} ?>>Northern Cape</option>
												<option value="8" <?php if(@$_POST['Location'] == "8"){ echo "selected='selected'";} ?>>North West</option>
												<option value="9" <?php if(@$_POST['Location'] == "9"){ echo "selected='selected'";} ?>>Western Cape</option>
											</select>
										</fieldset>
									</div>
									</div>
									
									<div class="col-md-3 col-3" style="float:left;">
									<div class="form-group">
										<label for="AcademicLevel">Academic Level of Qualification</label>
										<fieldset class="form-group">
											<select class="choices form-select" id="AcademicLevel" name="AcademicLevel">
											<option></option> 
											<?php $QualificationLevel = mysqli_query($conn,"SELECT distinct * FROM LookupQualificationLevel WHERE IsActive = '1' AND UserType = '4' ORDER BY Name ASC");

											while($QLevels = mysqli_fetch_array($QualificationLevel))
												{ ?>
												 <option value=" <?php echo $QLevels['ID']; ?> " <?php if(@$_POST['AcademicLevel'] == $QLevels['ID']){ echo "selected='selected'";} ?>><?php echo ucwords($QLevels['Name']); ?></option>
												<?php } ?>	
											</select>
										</fieldset>
									</div>
													
                                    </div>
									
									<div class="col-md-3 col-3" style="float:left">
										<div class="form-group">
										<label for="Discipline">Discipline/Area of Specialisation</label>
											<fieldset class="form-group">
												<select class="choices form-select" id="Discipline" name="Discipline">
												<option></option>
												<option value="27" <?php if(@$_POST['Discipline'] == "27"){ echo "selected='selected'";} ?>>Accounting</option>
												<option value="28" <?php if(@$_POST['Discipline'] == "28"){ echo "selected='selected'";} ?>>Accounting and finance</option>
												<option value="29" <?php if(@$_POST['Discipline'] == "29"){ echo "selected='selected'";} ?>>Accounting science</option>
												<option value="30" <?php if(@$_POST['Discipline'] == "30"){ echo "selected='selected'";} ?>>Actuarial Science</option>
												<option value="31" <?php if(@$_POST['Discipline'] == "31"){ echo "selected='selected'";} ?>>Acturial science</option>
												<option value="32" <?php if(@$_POST['Discipline'] == "32"){ echo "selected='selected'";} ?>>Additive manufacturing</option>
												<option value="33" <?php if(@$_POST['Discipline'] == "33"){ echo "selected='selected'";} ?>>Administration</option>
												<option value="34" <?php if(@$_POST['Discipline'] == "34"){ echo "selected='selected'";} ?>>Aeronautical and Aerospace</option>
												<option value="35" <?php if(@$_POST['Discipline'] == "35"){ echo "selected='selected'";} ?>>Aeronomy</option>
												<option value="36" <?php if(@$_POST['Discipline'] == "36"){ echo "selected='selected'";} ?>>Aerospace & Aeronautical Engineering</option>
												<option value="37" <?php if(@$_POST['Discipline'] == "37"){ echo "selected='selected'";} ?>>African Languages</option>
												<option value="38" <?php if(@$_POST['Discipline'] == "38"){ echo "selected='selected'";} ?>>AGRI (other)</option>
												<option value="39" <?php if(@$_POST['Discipline'] == "39"){ echo "selected='selected'";} ?>>Agribusiness</option>
												<option value="40" <?php if(@$_POST['Discipline'] == "40"){ echo "selected='selected'";} ?>>Agricultural Biotechnology</option>
												<option value="41" <?php if(@$_POST['Discipline'] == "41"){ echo "selected='selected'";} ?>>Agricultural Economics</option>
												<option value="42" <?php if(@$_POST['Discipline'] == "42"){ echo "selected='selected'";} ?>>Agricultural Engineering</option>
												<option value="43" <?php if(@$_POST['Discipline'] == "43"){ echo "selected='selected'";} ?>>Agricultural Extension</option>
												<option value="44" <?php if(@$_POST['Discipline'] == "44"){ echo "selected='selected'";} ?>>Agricultural Management</option>
												<option value="45" <?php if(@$_POST['Discipline'] == "45"){ echo "selected='selected'";} ?>>Agricultural Resource Management</option>
												<option value="46" <?php if(@$_POST['Discipline'] == "46"){ echo "selected='selected'";} ?>>Agricultural Sciences</option>
												<option value="47" <?php if(@$_POST['Discipline'] == "47"){ echo "selected='selected'";} ?>>Agriculture</option>
												<option value="48" <?php if(@$_POST['Discipline'] == "48"){ echo "selected='selected'";} ?>>Agriculture Economics</option>
												<option value="49" <?php if(@$_POST['Discipline'] == "49"){ echo "selected='selected'";} ?>>Agriculture Education </option>
												<option value="50" <?php if(@$_POST['Discipline'] == "50"){ echo "selected='selected'";} ?>>Agrometeorology</option>
												<option value="51" <?php if(@$_POST['Discipline'] == "51"){ echo "selected='selected'";} ?>>Agrometereology</option>
												<option value="52" <?php if(@$_POST['Discipline'] == "52"){ echo "selected='selected'";} ?>>Agroprocessing</option>
												<option value="53" <?php if(@$_POST['Discipline'] == "53"){ echo "selected='selected'";} ?>>Algebra, Number Theory, and Combinatorics</option>
												<option value="54" <?php if(@$_POST['Discipline'] == "54"){ echo "selected='selected'";} ?>>Algorithms and Theoretical Foundations</option>
												<option value="55" <?php if(@$_POST['Discipline'] == "55"){ echo "selected='selected'";} ?>>Anaesthesia & Pain Management</option>
												<option value="56" <?php if(@$_POST['Discipline'] == "56"){ echo "selected='selected'";} ?>>Anaesthesia and pain management</option>
												<option value="57" <?php if(@$_POST['Discipline'] == "57"){ echo "selected='selected'";} ?>>Analysis</option>
												<option value="58" <?php if(@$_POST['Discipline'] == "58"){ echo "selected='selected'";} ?>>Analytical Chemistry</option>
												<option value="59" <?php if(@$_POST['Discipline'] == "59"){ echo "selected='selected'";} ?>>Anatomical pathology</option>
												<option value="60" <?php if(@$_POST['Discipline'] == "60"){ echo "selected='selected'";} ?>>Anatomical Sciences</option>
												<option value="61" <?php if(@$_POST['Discipline'] == "61"){ echo "selected='selected'";} ?>>Animal and Veterinary Sciences</option>
												<option value="62" <?php if(@$_POST['Discipline'] == "62"){ echo "selected='selected'";} ?>>Animal Breeding & Genetics</option>
												<option value="63" <?php if(@$_POST['Discipline'] == "63"){ echo "selected='selected'";} ?>>Animal Diseases</option>
												<option value="64" <?php if(@$_POST['Discipline'] == "64"){ echo "selected='selected'";} ?>>Animal parasitology</option>
												<option value="65" <?php if(@$_POST['Discipline'] == "65"){ echo "selected='selected'";} ?>>Animal Production</option>
												<option value="66" <?php if(@$_POST['Discipline'] == "66"){ echo "selected='selected'";} ?>>Animal Science</option>
												<option value="67" <?php if(@$_POST['Discipline'] == "67"){ echo "selected='selected'";} ?>>Anthropology</option>
												<option value="68" <?php if(@$_POST['Discipline'] == "68"){ echo "selected='selected'";} ?>>Applied Mathematics</option>
												<option value="69" <?php if(@$_POST['Discipline'] == "69"){ echo "selected='selected'";} ?>>Archaeology</option>
												<option value="70" <?php if(@$_POST['Discipline'] == "70"){ echo "selected='selected'";} ?>>Architecture</option>
												<option value="71" <?php if(@$_POST['Discipline'] == "71"){ echo "selected='selected'";} ?>>Argriculture </option>
												<option value="72" <?php if(@$_POST['Discipline'] == "72"){ echo "selected='selected'";} ?>>Argrometereology</option>
												<option value="73" <?php if(@$_POST['Discipline'] == "73"){ echo "selected='selected'";} ?>>Artifical Intelligence</option>
												<option value="74" <?php if(@$_POST['Discipline'] == "74"){ echo "selected='selected'";} ?>>Artificial intelligence</option>
												<option value="75" <?php if(@$_POST['Discipline'] == "75"){ echo "selected='selected'";} ?>>Arts</option>
												<option value="76" <?php if(@$_POST['Discipline'] == "76"){ echo "selected='selected'";} ?>>Astronomy</option>
												<option value="77" <?php if(@$_POST['Discipline'] == "77"){ echo "selected='selected'";} ?>>Astrophysics</option>
												<option value="78" <?php if(@$_POST['Discipline'] == "78"){ echo "selected='selected'";} ?>>Atmospheric Chemistry</option>
												<option value="79" <?php if(@$_POST['Discipline'] == "79"){ echo "selected='selected'";} ?>>Atmospheric Science & Meteorology</option>
												<option value="80" <?php if(@$_POST['Discipline'] == "80"){ echo "selected='selected'";} ?>>Atomic and Molecular</option>
												<option value="81" <?php if(@$_POST['Discipline'] == "81"){ echo "selected='selected'";} ?>>Atomic, Molecular & Nuclear Physics</option>
												<option value="82" <?php if(@$_POST['Discipline'] == "82"){ echo "selected='selected'";} ?>>Atomic, Molecular, Nuclear Physics</option>
												<option value="83" <?php if(@$_POST['Discipline'] == "83"){ echo "selected='selected'";} ?>>Auditing</option>
												<option value="84" <?php if(@$_POST['Discipline'] == "84"){ echo "selected='selected'";} ?>>Automotive Engineering</option>
												<option value="85" <?php if(@$_POST['Discipline'] == "85"){ echo "selected='selected'";} ?>>Basic and Applied Microbiology</option>
												<option value="86" <?php if(@$_POST['Discipline'] == "86"){ echo "selected='selected'";} ?>>Basic Medical Science</option>
												<option value="87" <?php if(@$_POST['Discipline'] == "87"){ echo "selected='selected'";} ?>>Biochemistry</option>
												<option value="88" <?php if(@$_POST['Discipline'] == "88"){ echo "selected='selected'";} ?>>Bioengineering</option>
												<option value="89" <?php if(@$_POST['Discipline'] == "89"){ echo "selected='selected'";} ?>>Bio-engineering</option>
												<option value="90" <?php if(@$_POST['Discipline'] == "90"){ echo "selected='selected'";} ?>>Biogeochemistry</option>
												<option value="91" <?php if(@$_POST['Discipline'] == "91"){ echo "selected='selected'";} ?>>Bioinformatics</option>
												<option value="92" <?php if(@$_POST['Discipline'] == "92"){ echo "selected='selected'";} ?>>Bioinformatics and Computational Biology</option>
												<option value="93" <?php if(@$_POST['Discipline'] == "93"){ echo "selected='selected'";} ?>>Bioinformatics and other Informatics</option>
												<option value="94" <?php if(@$_POST['Discipline'] == "94"){ echo "selected='selected'";} ?>>Biological Oceanography</option>
												<option value="95" <?php if(@$_POST['Discipline'] == "95"){ echo "selected='selected'";} ?>>Biological science</option>
												<option value="96" <?php if(@$_POST['Discipline'] == "96"){ echo "selected='selected'";} ?>>Biological Sciences</option>
												<option value="97" <?php if(@$_POST['Discipline'] == "97"){ echo "selected='selected'";} ?>>Biology</option>
												<option value="98" <?php if(@$_POST['Discipline'] == "98"){ echo "selected='selected'";} ?>>Biomaterials</option>
												<option value="99" <?php if(@$_POST['Discipline'] == "99"){ echo "selected='selected'";} ?>>Biomedical Technology</option>
												<option value="100" <?php if(@$_POST['Discipline'] == "100"){ echo "selected='selected'";} ?>>Biometrics</option>
												<option value="101" <?php if(@$_POST['Discipline'] == "101"){ echo "selected='selected'";} ?>>Biophysics</option>
												<option value="102" <?php if(@$_POST['Discipline'] == "102"){ echo "selected='selected'";} ?>>Bioprocesses</option>
												<option value="103" <?php if(@$_POST['Discipline'] == "103"){ echo "selected='selected'";} ?>>Biostatistics</option>
												<option value="104" <?php if(@$_POST['Discipline'] == "104"){ echo "selected='selected'";} ?>>Biotechnology</option>
												<option value="105" <?php if(@$_POST['Discipline'] == "105"){ echo "selected='selected'";} ?>>Botany</option>
												<option value="106" <?php if(@$_POST['Discipline'] == "106"){ echo "selected='selected'";} ?>>Business administration</option>
												<option value="107" <?php if(@$_POST['Discipline'] == "107"){ echo "selected='selected'";} ?>>Business economics</option>
												<option value="108" <?php if(@$_POST['Discipline'] == "108"){ echo "selected='selected'";} ?>>Business Sciences </option>
												<option value="109" <?php if(@$_POST['Discipline'] == "109"){ echo "selected='selected'";} ?>>Capital Markets and Investments</option>
												<option value="110" <?php if(@$_POST['Discipline'] == "110"){ echo "selected='selected'";} ?>>Cardiology</option>
												<option value="111" <?php if(@$_POST['Discipline'] == "111"){ echo "selected='selected'";} ?>>Cardiovascular diseases</option>
												<option value="112" <?php if(@$_POST['Discipline'] == "112"){ echo "selected='selected'";} ?>>Cell Biology</option>
												<option value="113" <?php if(@$_POST['Discipline'] == "113"){ echo "selected='selected'";} ?>>Cellular and Molecular Biology</option>
												<option value="114" <?php if(@$_POST['Discipline'] == "114"){ echo "selected='selected'";} ?>>Ceramics</option>
												<option value="115" <?php if(@$_POST['Discipline'] == "115"){ echo "selected='selected'";} ?>>Chemical Catalysis</option>
												<option value="116" <?php if(@$_POST['Discipline'] == "116"){ echo "selected='selected'";} ?>>Chemical Engineering</option>
												<option value="117" <?php if(@$_POST['Discipline'] == "117"){ echo "selected='selected'";} ?>>Chemical Measurement and Imaging</option>
												<option value="118" <?php if(@$_POST['Discipline'] == "118"){ echo "selected='selected'";} ?>>Chemical Oceanography</option>
												<option value="119" <?php if(@$_POST['Discipline'] == "119"){ echo "selected='selected'";} ?>>Chemical Pathology</option>
												<option value="120" <?php if(@$_POST['Discipline'] == "120"){ echo "selected='selected'";} ?>>Chemical Sciences</option>
												<option value="121" <?php if(@$_POST['Discipline'] == "121"){ echo "selected='selected'";} ?>>Chemical Structure, Dynamics, and Mechanism</option>
												<option value="122" <?php if(@$_POST['Discipline'] == "122"){ echo "selected='selected'";} ?>>Chemical Synthesis</option>
												<option value="123" <?php if(@$_POST['Discipline'] == "123"){ echo "selected='selected'";} ?>>Chemical Theory, Models and Computational Methods</option>
												<option value="124" <?php if(@$_POST['Discipline'] == "124"){ echo "selected='selected'";} ?>>Chemistry</option>
												<option value="125" <?php if(@$_POST['Discipline'] == "125"){ echo "selected='selected'";} ?>>Chemistry of Life Processes</option>
												<option value="126" <?php if(@$_POST['Discipline'] == "126"){ echo "selected='selected'";} ?>>Chemistry of materials</option>
												<option value="127" <?php if(@$_POST['Discipline'] == "127"){ echo "selected='selected'";} ?>>Chemistry Sciences Engineering</option>
												<option value="128" <?php if(@$_POST['Discipline'] == "128"){ echo "selected='selected'";} ?>>Circuits</option>
												<option value="129" <?php if(@$_POST['Discipline'] == "129"){ echo "selected='selected'";} ?>>Civil Engineering</option>
												<option value="130" <?php if(@$_POST['Discipline'] == "130"){ echo "selected='selected'";} ?>>Civil procedure and courts</option>
												<option value="131" <?php if(@$_POST['Discipline'] == "131"){ echo "selected='selected'";} ?>>Classics</option>
												<option value="132" <?php if(@$_POST['Discipline'] == "132"){ echo "selected='selected'";} ?>>Climate and Large-Scale Atmospheric Dynamics</option>
												<option value="133" <?php if(@$_POST['Discipline'] == "133"){ echo "selected='selected'";} ?>>Climate Change</option>
												<option value="134" <?php if(@$_POST['Discipline'] == "134"){ echo "selected='selected'";} ?>>Clinical medicine</option>
												<option value="135" <?php if(@$_POST['Discipline'] == "135"){ echo "selected='selected'";} ?>>Collections Management</option>
												<option value="136" <?php if(@$_POST['Discipline'] == "136"){ echo "selected='selected'";} ?>>Commercial Law</option>
												<option value="137" <?php if(@$_POST['Discipline'] == "137"){ echo "selected='selected'";} ?>>Communication</option>
												<option value="138" <?php if(@$_POST['Discipline'] == "138"){ echo "selected='selected'";} ?>>Communication & Media Studies</option>
												<option value="139" <?php if(@$_POST['Discipline'] == "139"){ echo "selected='selected'";} ?>>Communication and Information Theory</option>
												<option value="140" <?php if(@$_POST['Discipline'] == "140"){ echo "selected='selected'";} ?>>Communication Technology</option>
												<option value="141" <?php if(@$_POST['Discipline'] == "141"){ echo "selected='selected'";} ?>>Comparative Law</option>
												<option value="142" <?php if(@$_POST['Discipline'] == "142"){ echo "selected='selected'";} ?>>Computational and Data-enabled Science</option>
												<option value="143" <?php if(@$_POST['Discipline'] == "143"){ echo "selected='selected'";} ?>>Computational Mathematics</option>
												<option value="144" <?php if(@$_POST['Discipline'] == "144"){ echo "selected='selected'";} ?>>Computational Science and Engineering</option>
												<option value="145" <?php if(@$_POST['Discipline'] == "145"){ echo "selected='selected'";} ?>>Computational Statistics</option>
												<option value="146" <?php if(@$_POST['Discipline'] == "146"){ echo "selected='selected'";} ?>>Computer Architecture</option>
												<option value="147" <?php if(@$_POST['Discipline'] == "147"){ echo "selected='selected'";} ?>>Computer Engineering</option>
												<option value="148" <?php if(@$_POST['Discipline'] == "148"){ echo "selected='selected'";} ?>>Computer Hardware</option>
												<option value="149" <?php if(@$_POST['Discipline'] == "149"){ echo "selected='selected'";} ?>>Computer multimedia systems</option>
												<option value="150" <?php if(@$_POST['Discipline'] == "150"){ echo "selected='selected'";} ?>>Computer Networks</option>
												<option value="151" <?php if(@$_POST['Discipline'] == "151"){ echo "selected='selected'";} ?>>Computer Programming</option>
												<option value="152" <?php if(@$_POST['Discipline'] == "152"){ echo "selected='selected'";} ?>>Computer Science and Information Systems</option>
												<option value="153" <?php if(@$_POST['Discipline'] == "153"){ echo "selected='selected'";} ?>>Computer Security and Privacy</option>
												<option value="154" <?php if(@$_POST['Discipline'] == "154"){ echo "selected='selected'";} ?>>Computer Software</option>
												<option value="155" <?php if(@$_POST['Discipline'] == "155"){ echo "selected='selected'";} ?>>Computer Systems and Embedded Systems</option>
												<option value="156" <?php if(@$_POST['Discipline'] == "156"){ echo "selected='selected'";} ?>>Condensed Matter</option>
												<option value="157" <?php if(@$_POST['Discipline'] == "157"){ echo "selected='selected'";} ?>>Constitutional and administrative law</option>
												<option value="158" <?php if(@$_POST['Discipline'] == "158"){ echo "selected='selected'";} ?>>Construction & Building</option>
												<option value="159" <?php if(@$_POST['Discipline'] == "159"){ echo "selected='selected'";} ?>>Construction Industry & Building</option>
												<option value="160" <?php if(@$_POST['Discipline'] == "160"){ echo "selected='selected'";} ?>>Construction industry and building</option>
												<option value="161" <?php if(@$_POST['Discipline'] == "161"){ echo "selected='selected'";} ?>>Corporate governance</option>
												<option value="162" <?php if(@$_POST['Discipline'] == "162"){ echo "selected='selected'";} ?>>Creative Arts</option>
												<option value="163" <?php if(@$_POST['Discipline'] == "163"){ echo "selected='selected'";} ?>>Criminal law</option>
												<option value="164" <?php if(@$_POST['Discipline'] == "164"){ echo "selected='selected'";} ?>>Criminology</option>
												<option value="165" <?php if(@$_POST['Discipline'] == "165"){ echo "selected='selected'";} ?>>CRM (other)</option>
												<option value="166" <?php if(@$_POST['Discipline'] == "166"){ echo "selected='selected'";} ?>>Cultural studies</option>
												<option value="167" <?php if(@$_POST['Discipline'] == "167"){ echo "selected='selected'";} ?>>Customary law</option>
												<option value="168" <?php if(@$_POST['Discipline'] == "168"){ echo "selected='selected'";} ?>>Dairy Science</option>
												<option value="169" <?php if(@$_POST['Discipline'] == "169"){ echo "selected='selected'";} ?>>Data Mining and Information Retrieval</option>
												<option value="170" <?php if(@$_POST['Discipline'] == "170"){ echo "selected='selected'";} ?>>Databases</option>
												<option value="171" <?php if(@$_POST['Discipline'] == "171"){ echo "selected='selected'";} ?>>Decorative arts</option>
												<option value="172" <?php if(@$_POST['Discipline'] == "172"){ echo "selected='selected'";} ?>>Degenerative diseases</option>
												<option value="173" <?php if(@$_POST['Discipline'] == "173"){ echo "selected='selected'";} ?>>Demography</option>
												<option value="174" <?php if(@$_POST['Discipline'] == "174"){ echo "selected='selected'";} ?>>Dental Sciences</option>
												<option value="175" <?php if(@$_POST['Discipline'] == "175"){ echo "selected='selected'";} ?>>Dermatology</option>
												<option value="176" <?php if(@$_POST['Discipline'] == "176"){ echo "selected='selected'";} ?>>Design studies</option>
												<option value="177" <?php if(@$_POST['Discipline'] == "177"){ echo "selected='selected'";} ?>>Development Studies</option>
												<option value="178" <?php if(@$_POST['Discipline'] == "178"){ echo "selected='selected'";} ?>>Developmental Biology</option>
												<option value="179" <?php if(@$_POST['Discipline'] == "179"){ echo "selected='selected'";} ?>>Developmental Studies</option>
												<option value="180" <?php if(@$_POST['Discipline'] == "180"){ echo "selected='selected'";} ?>>Diabetology</option>
												<option value="181" <?php if(@$_POST['Discipline'] == "181"){ echo "selected='selected'";} ?>>Dietetics</option>
												<option value="182" <?php if(@$_POST['Discipline'] == "182"){ echo "selected='selected'";} ?>>Dietetics </option>
												<option value="183" <?php if(@$_POST['Discipline'] == "183"){ echo "selected='selected'";} ?>>Diffusion</option>
												<option value="184" <?php if(@$_POST['Discipline'] == "184"){ echo "selected='selected'";} ?>>Dramatic arts</option>
												<option value="185" <?php if(@$_POST['Discipline'] == "185"){ echo "selected='selected'";} ?>>Drug discovery</option>
												<option value="186" <?php if(@$_POST['Discipline'] == "186"){ echo "selected='selected'";} ?>>Drug Discovery and Development</option>
												<option value="187" <?php if(@$_POST['Discipline'] == "187"){ echo "selected='selected'";} ?>>Earth and Related Environmental sciences</option>
												<option value="188" <?php if(@$_POST['Discipline'] == "188"){ echo "selected='selected'";} ?>>Earth Observation</option>
												<option value="189" <?php if(@$_POST['Discipline'] == "189"){ echo "selected='selected'";} ?>>Earth Science</option>
												<option value="190" <?php if(@$_POST['Discipline'] == "190"){ echo "selected='selected'";} ?>>Earth Sciences</option>
												<option value="191" <?php if(@$_POST['Discipline'] == "191"){ echo "selected='selected'";} ?>>Ecology</option>
												<option value="192" <?php if(@$_POST['Discipline'] == "192"){ echo "selected='selected'";} ?>>Ecology & Env Science</option>
												<option value="193" <?php if(@$_POST['Discipline'] == "193"){ echo "selected='selected'";} ?>>Ecology & Enviromental Science</option>
												<option value="194" <?php if(@$_POST['Discipline'] == "194"){ echo "selected='selected'";} ?>>Ecology & Environmental Science</option>
												<option value="195" <?php if(@$_POST['Discipline'] == "195"){ echo "selected='selected'";} ?>>Ecology & Environmental Sciences</option>
												<option value="196" <?php if(@$_POST['Discipline'] == "196"){ echo "selected='selected'";} ?>>Economic Sciences</option>
												<option value="197" <?php if(@$_POST['Discipline'] == "197"){ echo "selected='selected'";} ?>>Economics</option>
												<option value="198" <?php if(@$_POST['Discipline'] == "198"){ echo "selected='selected'";} ?>>Education</option>
												<option value="199" <?php if(@$_POST['Discipline'] == "199"){ echo "selected='selected'";} ?>>Education </option>
												<option value="200" <?php if(@$_POST['Discipline'] == "200"){ echo "selected='selected'";} ?>>Elasticity</option>
												<option value="201" <?php if(@$_POST['Discipline'] == "201"){ echo "selected='selected'";} ?>>Electrical Engineering</option>
												<option value="202" <?php if(@$_POST['Discipline'] == "202"){ echo "selected='selected'";} ?>>Electromagnetism</option>
												<option value="203" <?php if(@$_POST['Discipline'] == "203"){ echo "selected='selected'";} ?>>Electronic Engineering</option>
												<option value="204" <?php if(@$_POST['Discipline'] == "204"){ echo "selected='selected'";} ?>>Electronic materials</option>
												<option value="205" <?php if(@$_POST['Discipline'] == "205"){ echo "selected='selected'";} ?>>Electronics Engineering</option>
												<option value="206" <?php if(@$_POST['Discipline'] == "206"){ echo "selected='selected'";} ?>>EMAS (other)</option>
												<option value="207" <?php if(@$_POST['Discipline'] == "207"){ echo "selected='selected'";} ?>>Embryology & Fetal Development</option>
												<option value="208" <?php if(@$_POST['Discipline'] == "208"){ echo "selected='selected'";} ?>>Endocrinology</option>
												<option value="209" <?php if(@$_POST['Discipline'] == "209"){ echo "selected='selected'";} ?>>Energy</option>
												<option value="210" <?php if(@$_POST['Discipline'] == "210"){ echo "selected='selected'";} ?>>Energy Efficiency</option>
												<option value="211" <?php if(@$_POST['Discipline'] == "211"){ echo "selected='selected'";} ?>>ENG (other)</option>
												<option value="212" <?php if(@$_POST['Discipline'] == "212"){ echo "selected='selected'";} ?>>Engineering</option>
												<option value="213" <?php if(@$_POST['Discipline'] == "213"){ echo "selected='selected'";} ?>>Engineering Education</option>
												<option value="214" <?php if(@$_POST['Discipline'] == "214"){ echo "selected='selected'";} ?>>Engineering Management</option>
												<option value="215" <?php if(@$_POST['Discipline'] == "215"){ echo "selected='selected'";} ?>>Engineering Sciences</option>
												<option value="216" <?php if(@$_POST['Discipline'] == "216"){ echo "selected='selected'";} ?>>Entomology</option>
												<option value="217" <?php if(@$_POST['Discipline'] == "217"){ echo "selected='selected'";} ?>>Enviromental Engineering</option>
												<option value="218" <?php if(@$_POST['Discipline'] == "218"){ echo "selected='selected'";} ?>>Enviromental Studies</option>
												<option value="219" <?php if(@$_POST['Discipline'] == "219"){ echo "selected='selected'";} ?>>Environment</option>
												<option value="220" <?php if(@$_POST['Discipline'] == "220"){ echo "selected='selected'";} ?>>Environment Sciences</option>
												<option value="221" <?php if(@$_POST['Discipline'] == "221"){ echo "selected='selected'";} ?>>Environmental and Earth Sciences</option>
												<option value="222" <?php if(@$_POST['Discipline'] == "222"){ echo "selected='selected'";} ?>>Environmental Biology</option>
												<option value="223" <?php if(@$_POST['Discipline'] == "223"){ echo "selected='selected'";} ?>>Environmental biotechnology</option>
												<option value="224" <?php if(@$_POST['Discipline'] == "224"){ echo "selected='selected'";} ?>>Environmental Chemical Systems</option>
												<option value="225" <?php if(@$_POST['Discipline'] == "225"){ echo "selected='selected'";} ?>>Environmental Engineering</option>
												<option value="226" <?php if(@$_POST['Discipline'] == "226"){ echo "selected='selected'";} ?>>Environmental Health</option>
												<option value="227" <?php if(@$_POST['Discipline'] == "227"){ echo "selected='selected'";} ?>>Environmental Health </option>
												<option value="228" <?php if(@$_POST['Discipline'] == "228"){ echo "selected='selected'";} ?>>Environmental Sciences</option>
												<option value="229" <?php if(@$_POST['Discipline'] == "229"){ echo "selected='selected'";} ?>>Environmental Studies</option>
												<option value="230" <?php if(@$_POST['Discipline'] == "230"){ echo "selected='selected'";} ?>>Epidemiology</option>
												<option value="231" <?php if(@$_POST['Discipline'] == "231"){ echo "selected='selected'";} ?>>Epidemiology </option>
												<option value="232" <?php if(@$_POST['Discipline'] == "232"){ echo "selected='selected'";} ?>>Epidemiology, incl. burden of disease</option>
												<option value="233" <?php if(@$_POST['Discipline'] == "233"){ echo "selected='selected'";} ?>>Ergonomics and Sports science</option>
												<option value="234" <?php if(@$_POST['Discipline'] == "234"){ echo "selected='selected'";} ?>>Ethics</option>
												<option value="235" <?php if(@$_POST['Discipline'] == "235"){ echo "selected='selected'";} ?>>Evolution and developmental biology</option>
												<option value="236" <?php if(@$_POST['Discipline'] == "236"){ echo "selected='selected'";} ?>>Evolutionary Biology</option>
												<option value="237" <?php if(@$_POST['Discipline'] == "237"){ echo "selected='selected'";} ?>>Financial Management</option>
												<option value="238" <?php if(@$_POST['Discipline'] == "238"){ echo "selected='selected'";} ?>>Fine arts</option>
												<option value="239" <?php if(@$_POST['Discipline'] == "239"){ echo "selected='selected'";} ?>>Fisheries</option>
												<option value="240" <?php if(@$_POST['Discipline'] == "240"){ echo "selected='selected'";} ?>>Fisheries </option>
												<option value="241" <?php if(@$_POST['Discipline'] == "241"){ echo "selected='selected'";} ?>>Fluids  </option>
												<option value="242" <?php if(@$_POST['Discipline'] == "242"){ echo "selected='selected'";} ?>>Food Science & Technology</option>
												<option value="243" <?php if(@$_POST['Discipline'] == "243"){ echo "selected='selected'";} ?>>Food Sciences & Technologies</option>
												<option value="244" <?php if(@$_POST['Discipline'] == "244"){ echo "selected='selected'";} ?>>Food Sciences & Technology</option>
												<option value="245" <?php if(@$_POST['Discipline'] == "245"){ echo "selected='selected'";} ?>>Food sciences and technology</option>
												<option value="246" <?php if(@$_POST['Discipline'] == "246"){ echo "selected='selected'";} ?>>Food Technology</option>
												<option value="247" <?php if(@$_POST['Discipline'] == "247"){ echo "selected='selected'";} ?>>Forensic Sciences</option>
												<option value="248" <?php if(@$_POST['Discipline'] == "248"){ echo "selected='selected'";} ?>>Forest Science</option>
												<option value="249" <?php if(@$_POST['Discipline'] == "249"){ echo "selected='selected'";} ?>>Forestry</option>
												<option value="250" <?php if(@$_POST['Discipline'] == "250"){ echo "selected='selected'";} ?>>Formal Methods, Verification, and Programming Languages</option>
												<option value="251" <?php if(@$_POST['Discipline'] == "251"){ echo "selected='selected'";} ?>>Fresh Water Biology</option>
												<option value="252" <?php if(@$_POST['Discipline'] == "252"){ echo "selected='selected'";} ?>>Fresh Water Biology & Limnology</option>
												<option value="253" <?php if(@$_POST['Discipline'] == "253"){ echo "selected='selected'";} ?>>Functional Genomics</option>
												<option value="254" <?php if(@$_POST['Discipline'] == "254"){ echo "selected='selected'";} ?>>Game Ranching & Farming</option>
												<option value="255" <?php if(@$_POST['Discipline'] == "255"){ echo "selected='selected'";} ?>>Game ranching and farming</option>
												<option value="256" <?php if(@$_POST['Discipline'] == "256"){ echo "selected='selected'";} ?>>Gastrointestinal diseases</option>
												<option value="257" <?php if(@$_POST['Discipline'] == "257"){ echo "selected='selected'";} ?>>General practice</option>
												<option value="258" <?php if(@$_POST['Discipline'] == "258"){ echo "selected='selected'";} ?>>Genetics</option>
												<option value="259" <?php if(@$_POST['Discipline'] == "259"){ echo "selected='selected'";} ?>>Genito-urinary diseases (incl. Urology)</option>
												<option value="260" <?php if(@$_POST['Discipline'] == "260"){ echo "selected='selected'";} ?>>Genomic biology</option>
												<option value="261" <?php if(@$_POST['Discipline'] == "261"){ echo "selected='selected'";} ?>>Genomics</option>
												<option value="262" <?php if(@$_POST['Discipline'] == "262"){ echo "selected='selected'";} ?>>Geobiology</option>
												<option value="263" <?php if(@$_POST['Discipline'] == "263"){ echo "selected='selected'";} ?>>Geochemistry</option>
												<option value="264" <?php if(@$_POST['Discipline'] == "264"){ echo "selected='selected'";} ?>>Geodynamics</option>
												<option value="265" <?php if(@$_POST['Discipline'] == "265"){ echo "selected='selected'";} ?>>Geographic Information Science</option>
												<option value="266" <?php if(@$_POST['Discipline'] == "266"){ echo "selected='selected'";} ?>>Geographic Information Systems</option>
												<option value="267" <?php if(@$_POST['Discipline'] == "267"){ echo "selected='selected'";} ?>>Geography</option>
												<option value="268" <?php if(@$_POST['Discipline'] == "268"){ echo "selected='selected'";} ?>>Geohydrology</option>
												<option value="269" <?php if(@$_POST['Discipline'] == "269"){ echo "selected='selected'";} ?>>Geology</option>
												<option value="270" <?php if(@$_POST['Discipline'] == "270"){ echo "selected='selected'";} ?>>Geometric Analysis</option>
												<option value="271" <?php if(@$_POST['Discipline'] == "271"){ echo "selected='selected'";} ?>>Geomorphology</option>
												<option value="272" <?php if(@$_POST['Discipline'] == "272"){ echo "selected='selected'";} ?>>Geophysics</option>
												<option value="273" <?php if(@$_POST['Discipline'] == "273"){ echo "selected='selected'";} ?>>Geosciences (other)</option>
												<option value="274" <?php if(@$_POST['Discipline'] == "274"){ echo "selected='selected'";} ?>>Geospace Physics</option>
												<option value="275" <?php if(@$_POST['Discipline'] == "275"){ echo "selected='selected'";} ?>>Geriatrics</option>
												<option value="276" <?php if(@$_POST['Discipline'] == "276"){ echo "selected='selected'";} ?>>Glaciology</option>
												<option value="277" <?php if(@$_POST['Discipline'] == "277"){ echo "selected='selected'";} ?>>Global Change, Society and Sustainability</option>
												<option value="278" <?php if(@$_POST['Discipline'] == "278"){ echo "selected='selected'";} ?>>GMS (other)</option>
												<option value="279" <?php if(@$_POST['Discipline'] == "279"){ echo "selected='selected'";} ?>>Graphics and Visualization</option>
												<option value="280" <?php if(@$_POST['Discipline'] == "280"){ echo "selected='selected'";} ?>>Gynaecology</option>
												<option value="281" <?php if(@$_POST['Discipline'] == "281"){ echo "selected='selected'";} ?>>Haematology</option>
												<option value="282" <?php if(@$_POST['Discipline'] == "282"){ echo "selected='selected'";} ?>>Health</option>
												<option value="283" <?php if(@$_POST['Discipline'] == "283"){ echo "selected='selected'";} ?>>Health Economics</option>
												<option value="284" <?php if(@$_POST['Discipline'] == "284"){ echo "selected='selected'";} ?>>Health Informatics</option>
												<option value="285" <?php if(@$_POST['Discipline'] == "285"){ echo "selected='selected'";} ?>>Health Promotion</option>
												<option value="286" <?php if(@$_POST['Discipline'] == "286"){ echo "selected='selected'";} ?>>Health Promotion </option>
												<option value="287" <?php if(@$_POST['Discipline'] == "287"){ echo "selected='selected'";} ?>>Health promotion &  Diesease Prevention</option>
												<option value="288" <?php if(@$_POST['Discipline'] == "288"){ echo "selected='selected'";} ?>>Health Promotion & Diease Prevention</option>
												<option value="289" <?php if(@$_POST['Discipline'] == "289"){ echo "selected='selected'";} ?>>Health Promotion & Disease Prevention</option>
												<option value="290" <?php if(@$_POST['Discipline'] == "290"){ echo "selected='selected'";} ?>>Health Sciences</option>
												<option value="291" <?php if(@$_POST['Discipline'] == "291"){ echo "selected='selected'";} ?>>Health Systems & Research</option>
												<option value="292" <?php if(@$_POST['Discipline'] == "292"){ echo "selected='selected'";} ?>>Health Systems Research</option>
												<option value="293" <?php if(@$_POST['Discipline'] == "293"){ echo "selected='selected'";} ?>>Health Technology</option>
												<option value="294" <?php if(@$_POST['Discipline'] == "294"){ echo "selected='selected'";} ?>>Heath Economics</option>
												<option value="295" <?php if(@$_POST['Discipline'] == "295"){ echo "selected='selected'";} ?>>Historical studies</option>
												<option value="296" <?php if(@$_POST['Discipline'] == "296"){ echo "selected='selected'";} ?>>History of arts</option>
												<option value="297" <?php if(@$_POST['Discipline'] == "297"){ echo "selected='selected'";} ?>>HMS (other)</option>
												<option value="298" <?php if(@$_POST['Discipline'] == "298"){ echo "selected='selected'";} ?>>Home economics</option>
												<option value="299" <?php if(@$_POST['Discipline'] == "299"){ echo "selected='selected'";} ?>>Horticulture</option>
												<option value="300" <?php if(@$_POST['Discipline'] == "300"){ echo "selected='selected'";} ?>>Horticulture </option>
												<option value="301" <?php if(@$_POST['Discipline'] == "301"){ echo "selected='selected'";} ?>>Human anatomy and physiology</option>
												<option value="302" <?php if(@$_POST['Discipline'] == "302"){ echo "selected='selected'";} ?>>Human Computer Interaction</option>
												<option value="303" <?php if(@$_POST['Discipline'] == "303"){ echo "selected='selected'";} ?>>Human geography</option>
												<option value="304" <?php if(@$_POST['Discipline'] == "304"){ echo "selected='selected'";} ?>>Human Movement science</option>
												<option value="305" <?php if(@$_POST['Discipline'] == "305"){ echo "selected='selected'";} ?>>Human Movement Sciences</option>
												<option value="306" <?php if(@$_POST['Discipline'] == "306"){ echo "selected='selected'";} ?>>Human Physiology</option>
												<option value="307" <?php if(@$_POST['Discipline'] == "307"){ echo "selected='selected'";} ?>>Human Resources</option>
												<option value="308" <?php if(@$_POST['Discipline'] == "308"){ echo "selected='selected'";} ?>>Human Systems Research</option>
												<option value="309" <?php if(@$_POST['Discipline'] == "309"){ echo "selected='selected'";} ?>>Humanities</option>
												<option value="310" <?php if(@$_POST['Discipline'] == "310"){ echo "selected='selected'";} ?>>Humanities and Arts</option>
												<option value="311" <?php if(@$_POST['Discipline'] == "311"){ echo "selected='selected'";} ?>>Hydrology</option>
												<option value="312" <?php if(@$_POST['Discipline'] == "312"){ echo "selected='selected'";} ?>>ICT</option>
												<option value="313" <?php if(@$_POST['Discipline'] == "313"){ echo "selected='selected'";} ?>>Immunology</option>
												<option value="314" <?php if(@$_POST['Discipline'] == "314"){ echo "selected='selected'";} ?>>Immunology, Virology and Infectious diseases</option>
												<option value="315" <?php if(@$_POST['Discipline'] == "315"){ echo "selected='selected'";} ?>>Indigenous Knowledge Systems</option>
												<option value="316" <?php if(@$_POST['Discipline'] == "316"){ echo "selected='selected'";} ?>>Industrial Biotechnology</option>
												<option value="317" <?php if(@$_POST['Discipline'] == "317"){ echo "selected='selected'";} ?>>Industrial design</option>
												<option value="318" <?php if(@$_POST['Discipline'] == "318"){ echo "selected='selected'";} ?>>Industrial Engineering</option>
												<option value="319" <?php if(@$_POST['Discipline'] == "319"){ echo "selected='selected'";} ?>>Industrial Engineering & Operations Research</option>
												<option value="320" <?php if(@$_POST['Discipline'] == "320"){ echo "selected='selected'";} ?>>Industrial Psychology</option>
												<option value="321" <?php if(@$_POST['Discipline'] == "321"){ echo "selected='selected'";} ?>>Industrial Psychology & Sociology</option>
												<option value="322" <?php if(@$_POST['Discipline'] == "322"){ echo "selected='selected'";} ?>>Infectious Diseases</option>
												<option value="323" <?php if(@$_POST['Discipline'] == "323"){ echo "selected='selected'";} ?>>Infomation Systems & Technologies</option>
												<option value="324" <?php if(@$_POST['Discipline'] == "324"){ echo "selected='selected'";} ?>>Information  & Computer Technologies</option>
												<option value="325" <?php if(@$_POST['Discipline'] == "325"){ echo "selected='selected'";} ?>>Information & Computer Science</option>
												<option value="326" <?php if(@$_POST['Discipline'] == "326"){ echo "selected='selected'";} ?>>Information & Computer Sciences</option>
												<option value="327" <?php if(@$_POST['Discipline'] == "327"){ echo "selected='selected'";} ?>>Information & Computer Technologies</option>
												<option value="328" <?php if(@$_POST['Discipline'] == "328"){ echo "selected='selected'";} ?>>Information & Computer Technology</option>
												<option value="329" <?php if(@$_POST['Discipline'] == "329"){ echo "selected='selected'";} ?>>Information & Library Science</option>
												<option value="330" <?php if(@$_POST['Discipline'] == "330"){ echo "selected='selected'";} ?>>Information & Library Sciences</option>
												<option value="331" <?php if(@$_POST['Discipline'] == "331"){ echo "selected='selected'";} ?>>Information and Communication Technology (ICT)</option>
												<option value="332" <?php if(@$_POST['Discipline'] == "332"){ echo "selected='selected'";} ?>>Information and Computer science</option>
												<option value="333" <?php if(@$_POST['Discipline'] == "333"){ echo "selected='selected'";} ?>>Information Communication Technology</option>
												<option value="334" <?php if(@$_POST['Discipline'] == "334"){ echo "selected='selected'";} ?>>Information Engineering</option>
												<option value="335" <?php if(@$_POST['Discipline'] == "335"){ echo "selected='selected'";} ?>>Information Management</option>
												<option value="336" <?php if(@$_POST['Discipline'] == "336"){ echo "selected='selected'";} ?>>Information Mangagement</option>
												<option value="337" <?php if(@$_POST['Discipline'] == "337"){ echo "selected='selected'";} ?>>Information Science</option>
												<option value="338" <?php if(@$_POST['Discipline'] == "338"){ echo "selected='selected'";} ?>>Information Systems</option>
												<option value="339" <?php if(@$_POST['Discipline'] == "339"){ echo "selected='selected'";} ?>>Information Systems & Technologies</option>
												<option value="340" <?php if(@$_POST['Discipline'] == "340"){ echo "selected='selected'";} ?>>Information Systems & Technology</option>
												<option value="341" <?php if(@$_POST['Discipline'] == "341"){ echo "selected='selected'";} ?>>Information Technology</option>
												<option value="342" <?php if(@$_POST['Discipline'] == "342"){ echo "selected='selected'";} ?>>Information, Communication, Control Systems</option>
												<option value="343" <?php if(@$_POST['Discipline'] == "343"){ echo "selected='selected'";} ?>>Informations Systems</option>
												<option value="344" <?php if(@$_POST['Discipline'] == "344"){ echo "selected='selected'";} ?>>Innovation & Technology Transfer</option>
												<option value="345" <?php if(@$_POST['Discipline'] == "345"){ echo "selected='selected'";} ?>>Inorganic Chemistry</option>
												<option value="346" <?php if(@$_POST['Discipline'] == "346"){ echo "selected='selected'";} ?>>Intensive care</option>
												<option value="347" <?php if(@$_POST['Discipline'] == "347"){ echo "selected='selected'";} ?>>International law</option>
												<option value="348" <?php if(@$_POST['Discipline'] == "348"){ echo "selected='selected'";} ?>>International Relations</option>
												<option value="349" <?php if(@$_POST['Discipline'] == "349"){ echo "selected='selected'";} ?>>Invertebrate Taxonomy</option>
												<option value="350" <?php if(@$_POST['Discipline'] == "350"){ echo "selected='selected'";} ?>>IT Graphic Design</option>
												<option value="351" <?php if(@$_POST['Discipline'] == "351"){ echo "selected='selected'";} ?>>IT-Graphic Design</option>
												<option value="352" <?php if(@$_POST['Discipline'] == "352"){ echo "selected='selected'";} ?>>Jurisprudence</option>
												<option value="353" <?php if(@$_POST['Discipline'] == "353"){ echo "selected='selected'";} ?>>Knowledge Management (Records Administration)</option>
												<option value="354" <?php if(@$_POST['Discipline'] == "354"){ echo "selected='selected'";} ?>>Labour, social service, education and cultural law</option>
												<option value="355" <?php if(@$_POST['Discipline'] == "355"){ echo "selected='selected'";} ?>>Languages</option>
												<option value="356" <?php if(@$_POST['Discipline'] == "356"){ echo "selected='selected'";} ?>>Languages & Literature</option>
												<option value="357" <?php if(@$_POST['Discipline'] == "357"){ echo "selected='selected'";} ?>>Languages and literature</option>
												<option value="358" <?php if(@$_POST['Discipline'] == "358"){ echo "selected='selected'";} ?>>Law</option>
												<option value="359" <?php if(@$_POST['Discipline'] == "359"){ echo "selected='selected'";} ?>>Laws (Statutes), regulations, cases</option>
												<option value="360" <?php if(@$_POST['Discipline'] == "360"){ echo "selected='selected'";} ?>>Leadership</option>
												<option value="361" <?php if(@$_POST['Discipline'] == "361"){ echo "selected='selected'";} ?>>Legal history</option>
												<option value="362" <?php if(@$_POST['Discipline'] == "362"){ echo "selected='selected'";} ?>>Librarianship</option>
												<option value="363" <?php if(@$_POST['Discipline'] == "363"){ echo "selected='selected'";} ?>>Library and Information Sciences</option>
												<option value="364" <?php if(@$_POST['Discipline'] == "364"){ echo "selected='selected'";} ?>>Library Science</option>
												<option value="365" <?php if(@$_POST['Discipline'] == "365"){ echo "selected='selected'";} ?>>Library Sciences</option>
												<option value="366" <?php if(@$_POST['Discipline'] == "366"){ echo "selected='selected'";} ?>>Library Services</option>
												<option value="367" <?php if(@$_POST['Discipline'] == "367"){ echo "selected='selected'";} ?>>Limnology</option>
												<option value="368" <?php if(@$_POST['Discipline'] == "368"){ echo "selected='selected'";} ?>>Linguistics</option>
												<option value="369" <?php if(@$_POST['Discipline'] == "369"){ echo "selected='selected'";} ?>>Literature</option>
												<option value="370" <?php if(@$_POST['Discipline'] == "370"){ echo "selected='selected'";} ?>>Logic or Foundations of Mathematics</option>
												<option value="371" <?php if(@$_POST['Discipline'] == "371"){ echo "selected='selected'";} ?>>Machine Learning</option>
												<option value="372" <?php if(@$_POST['Discipline'] == "372"){ echo "selected='selected'";} ?>>Macro-Invertebrates</option>
												<option value="373" <?php if(@$_POST['Discipline'] == "373"){ echo "selected='selected'";} ?>>Macromolecular, Supramolecular, and Nanochemistry</option>
												<option value="374" <?php if(@$_POST['Discipline'] == "374"){ echo "selected='selected'";} ?>>Magnetospheric Physics</option>
												<option value="375" <?php if(@$_POST['Discipline'] == "375"){ echo "selected='selected'";} ?>>Management</option>
												<option value="376" <?php if(@$_POST['Discipline'] == "376"){ echo "selected='selected'";} ?>>Management Sciences</option>
												<option value="377" <?php if(@$_POST['Discipline'] == "377"){ echo "selected='selected'";} ?>>Management Studies</option>
												<option value="378" <?php if(@$_POST['Discipline'] == "378"){ echo "selected='selected'";} ?>>Manufacturing & Process Techniques</option>
												<option value="379" <?php if(@$_POST['Discipline'] == "379"){ echo "selected='selected'";} ?>>Manufacturing & Process Technologies</option>
												<option value="380" <?php if(@$_POST['Discipline'] == "380"){ echo "selected='selected'";} ?>>Marine Biology</option>
												<option value="381" <?php if(@$_POST['Discipline'] == "381"){ echo "selected='selected'";} ?>>Marine Engineering & Naval Architecture</option>
												<option value="382" <?php if(@$_POST['Discipline'] == "382"){ echo "selected='selected'";} ?>>Marine engineering and navel architecture</option>
												<option value="383" <?php if(@$_POST['Discipline'] == "383"){ echo "selected='selected'";} ?>>Marine Geology and Geophysics</option>
												<option value="384" <?php if(@$_POST['Discipline'] == "384"){ echo "selected='selected'";} ?>>Marine Sciences</option>
												<option value="385" <?php if(@$_POST['Discipline'] == "385"){ echo "selected='selected'";} ?>>Marketing</option>
												<option value="386" <?php if(@$_POST['Discipline'] == "386"){ echo "selected='selected'";} ?>>Material Science & Technologies</option>
												<option value="387" <?php if(@$_POST['Discipline'] == "387"){ echo "selected='selected'";} ?>>Material Sciences & Technologies</option>
												<option value="388" <?php if(@$_POST['Discipline'] == "388"){ echo "selected='selected'";} ?>>Materials and Manufacturing</option>
												<option value="389" <?php if(@$_POST['Discipline'] == "389"){ echo "selected='selected'";} ?>>Materials engineering</option>
												<option value="390" <?php if(@$_POST['Discipline'] == "390"){ echo "selected='selected'";} ?>>Materials theory and Research</option>
												<option value="391" <?php if(@$_POST['Discipline'] == "391"){ echo "selected='selected'";} ?>>Mathematical Biology</option>
												<option value="392" <?php if(@$_POST['Discipline'] == "392"){ echo "selected='selected'";} ?>>Mathematical Science</option>
												<option value="393" <?php if(@$_POST['Discipline'] == "393"){ echo "selected='selected'";} ?>>Mathematical Sciences</option>
												<option value="394" <?php if(@$_POST['Discipline'] == "394"){ echo "selected='selected'";} ?>>Mathematics</option>
												<option value="395" <?php if(@$_POST['Discipline'] == "395"){ echo "selected='selected'";} ?>>Mathematics (other)</option>
												<option value="396" <?php if(@$_POST['Discipline'] == "396"){ echo "selected='selected'";} ?>>Mathematics Education</option>
												<option value="397" <?php if(@$_POST['Discipline'] == "397"){ echo "selected='selected'";} ?>>Mechanical Engineering</option>
												<option value="398" <?php if(@$_POST['Discipline'] == "398"){ echo "selected='selected'";} ?>>Mechanics</option>
												<option value="399" <?php if(@$_POST['Discipline'] == "399"){ echo "selected='selected'";} ?>>Mechnical Engineering</option>
												<option value="400" <?php if(@$_POST['Discipline'] == "400"){ echo "selected='selected'";} ?>>Media & Communications</option>
												<option value="401" <?php if(@$_POST['Discipline'] == "401"){ echo "selected='selected'";} ?>>Media Studies</option>
												<option value="402" <?php if(@$_POST['Discipline'] == "402"){ echo "selected='selected'";} ?>>Medical Biotechnology</option>
												<option value="403" <?php if(@$_POST['Discipline'] == "403"){ echo "selected='selected'";} ?>>Medical engineering</option>
												<option value="404" <?php if(@$_POST['Discipline'] == "404"){ echo "selected='selected'";} ?>>Medical Microbiology</option>
												<option value="405" <?php if(@$_POST['Discipline'] == "405"){ echo "selected='selected'";} ?>>Medical Microbiology </option>
												<option value="406" <?php if(@$_POST['Discipline'] == "406"){ echo "selected='selected'";} ?>>Medical Sciences</option>
												<option value="407" <?php if(@$_POST['Discipline'] == "407"){ echo "selected='selected'";} ?>>Medical sciences: Basic</option>
												<option value="408" <?php if(@$_POST['Discipline'] == "408"){ echo "selected='selected'";} ?>>Medical sciences: Clinical</option>
												<option value="409" <?php if(@$_POST['Discipline'] == "409"){ echo "selected='selected'";} ?>>Medical Technologies</option>
												<option value="410" <?php if(@$_POST['Discipline'] == "410"){ echo "selected='selected'";} ?>>Medical Virology</option>
												<option value="411" <?php if(@$_POST['Discipline'] == "411"){ echo "selected='selected'";} ?>>Medicinal Plant Research</option>
												<option value="412" <?php if(@$_POST['Discipline'] == "412"){ echo "selected='selected'";} ?>>Mental Health & Substance Abuse</option>
												<option value="413" <?php if(@$_POST['Discipline'] == "413"){ echo "selected='selected'";} ?>>Mental health and substance abuse</option>
												<option value="414" <?php if(@$_POST['Discipline'] == "414"){ echo "selected='selected'";} ?>>Metabolic diseases</option>
												<option value="415" <?php if(@$_POST['Discipline'] == "415"){ echo "selected='selected'";} ?>>Metallic materials</option>
												<option value="416" <?php if(@$_POST['Discipline'] == "416"){ echo "selected='selected'";} ?>>Metallurgical Engineering</option>
												<option value="417" <?php if(@$_POST['Discipline'] == "417"){ echo "selected='selected'";} ?>>Microbiology</option>
												<option value="418" <?php if(@$_POST['Discipline'] == "418"){ echo "selected='selected'";} ?>>Military and defence law</option>
												<option value="419" <?php if(@$_POST['Discipline'] == "419"){ echo "selected='selected'";} ?>>Mining and Mineral Processing</option>
												<option value="420" <?php if(@$_POST['Discipline'] == "420"){ echo "selected='selected'";} ?>>Mining engineering</option>
												<option value="421" <?php if(@$_POST['Discipline'] == "421"){ echo "selected='selected'";} ?>>Molecular & Cell Biology</option>
												<option value="422" <?php if(@$_POST['Discipline'] == "422"){ echo "selected='selected'";} ?>>Molecular and Cell Biology</option>
												<option value="423" <?php if(@$_POST['Discipline'] == "423"){ echo "selected='selected'";} ?>>Molecular cell biology</option>
												<option value="424" <?php if(@$_POST['Discipline'] == "424"){ echo "selected='selected'";} ?>>Molecular modelling</option>
												<option value="425" <?php if(@$_POST['Discipline'] == "425"){ echo "selected='selected'";} ?>>Morphology</option>
												<option value="426" <?php if(@$_POST['Discipline'] == "426"){ echo "selected='selected'";} ?>>Music</option>
												<option value="427" <?php if(@$_POST['Discipline'] == "427"){ echo "selected='selected'";} ?>>Musicology</option>
												<option value="428" <?php if(@$_POST['Discipline'] == "428"){ echo "selected='selected'";} ?>>Nanotechnology</option>
												<option value="429" <?php if(@$_POST['Discipline'] == "429"){ echo "selected='selected'";} ?>>Natural Language Processing</option>
												<option value="430" <?php if(@$_POST['Discipline'] == "430"){ echo "selected='selected'";} ?>>Natural Science</option>
												<option value="431" <?php if(@$_POST['Discipline'] == "431"){ echo "selected='selected'";} ?>>Natural Sciences</option>
												<option value="432" <?php if(@$_POST['Discipline'] == "432"){ echo "selected='selected'";} ?>>Neurology</option>
												<option value="433" <?php if(@$_POST['Discipline'] == "433"){ echo "selected='selected'";} ?>>Neurology and Psychiatry</option>
												<option value="434" <?php if(@$_POST['Discipline'] == "434"){ echo "selected='selected'";} ?>>Neuroscience</option>
												<option value="435" <?php if(@$_POST['Discipline'] == "435"){ echo "selected='selected'";} ?>>Neurosciences</option>
												<option value="436" <?php if(@$_POST['Discipline'] == "436"){ echo "selected='selected'";} ?>>NLS (other)</option>
												<option value="437" <?php if(@$_POST['Discipline'] == "437"){ echo "selected='selected'";} ?>>Nuclear Engineering</option>
												<option value="438" <?php if(@$_POST['Discipline'] == "438"){ echo "selected='selected'";} ?>>Nuclear Medicine & Organ Imaging</option>
												<option value="439" <?php if(@$_POST['Discipline'] == "439"){ echo "selected='selected'";} ?>>Nuclear physics</option>
												<option value="440" <?php if(@$_POST['Discipline'] == "440"){ echo "selected='selected'";} ?>>Nuclear Technologies in Medicine and Biosciences</option>
												<option value="441" <?php if(@$_POST['Discipline'] == "441"){ echo "selected='selected'";} ?>>Nursing Science</option>
												<option value="442" <?php if(@$_POST['Discipline'] == "442"){ echo "selected='selected'";} ?>>Nutrition</option>
												<option value="443" <?php if(@$_POST['Discipline'] == "443"){ echo "selected='selected'";} ?>>Nutrition </option>
												<option value="444" <?php if(@$_POST['Discipline'] == "444"){ echo "selected='selected'";} ?>>Nutrition & Metabolism</option>
												<option value="445" <?php if(@$_POST['Discipline'] == "445"){ echo "selected='selected'";} ?>>Nutrition and Pediatrics</option>
												<option value="446" <?php if(@$_POST['Discipline'] == "446"){ echo "selected='selected'";} ?>>Obstetrics & Maternal Health</option>
												<option value="447" <?php if(@$_POST['Discipline'] == "447"){ echo "selected='selected'";} ?>>Obstetrics and maternal health</option>
												<option value="448" <?php if(@$_POST['Discipline'] == "448"){ echo "selected='selected'";} ?>>Occupational health</option>
												<option value="449" <?php if(@$_POST['Discipline'] == "449"){ echo "selected='selected'";} ?>>Oceanography</option>
												<option value="450" <?php if(@$_POST['Discipline'] == "450"){ echo "selected='selected'";} ?>>Oceanology</option>
												<option value="451" <?php if(@$_POST['Discipline'] == "451"){ echo "selected='selected'";} ?>>Oncology</option>
												<option value="452" <?php if(@$_POST['Discipline'] == "452"){ echo "selected='selected'";} ?>>Operations research</option>
												<option value="453" <?php if(@$_POST['Discipline'] == "453"){ echo "selected='selected'";} ?>>Ophthalmology</option>
												<option value="454" <?php if(@$_POST['Discipline'] == "454"){ echo "selected='selected'";} ?>>Optical Engineering</option>
												<option value="455" <?php if(@$_POST['Discipline'] == "455"){ echo "selected='selected'";} ?>>Optics</option>
												<option value="456" <?php if(@$_POST['Discipline'] == "456"){ echo "selected='selected'";} ?>>Organic Chemistry</option>
												<option value="457" <?php if(@$_POST['Discipline'] == "457"){ echo "selected='selected'";} ?>>Organic Sciences</option>
												<option value="458" <?php if(@$_POST['Discipline'] == "458"){ echo "selected='selected'";} ?>>Organismal Biology</option>
												<option value="459" <?php if(@$_POST['Discipline'] == "459"){ echo "selected='selected'";} ?>>Orthopaedics</option>
												<option value="460" <?php if(@$_POST['Discipline'] == "460"){ echo "selected='selected'";} ?>>Other</option>
												<option value="461" <?php if(@$_POST['Discipline'] == "461"){ echo "selected='selected'";} ?>>Other information and computer technologies</option>
												<option value="462" <?php if(@$_POST['Discipline'] == "462"){ echo "selected='selected'";} ?>>Otorhinolaryngology</option>
												<option value="463" <?php if(@$_POST['Discipline'] == "463"){ echo "selected='selected'";} ?>>Paediatrics & Child Health</option>
												<option value="464" <?php if(@$_POST['Discipline'] == "464"){ echo "selected='selected'";} ?>>Paediatrics and child health</option>
												<option value="465" <?php if(@$_POST['Discipline'] == "465"){ echo "selected='selected'";} ?>>Painting</option>
												<option value="466" <?php if(@$_POST['Discipline'] == "466"){ echo "selected='selected'";} ?>>Palaeontology</option>
												<option value="467" <?php if(@$_POST['Discipline'] == "467"){ echo "selected='selected'";} ?>>Palaeosciences</option>
												<option value="468" <?php if(@$_POST['Discipline'] == "468"){ echo "selected='selected'";} ?>>Paleoclimate</option>
												<option value="469" <?php if(@$_POST['Discipline'] == "469"){ echo "selected='selected'";} ?>>Paleontology</option>
												<option value="470" <?php if(@$_POST['Discipline'] == "470"){ echo "selected='selected'";} ?>>Paleontology and Paleobiology</option>
												<option value="471" <?php if(@$_POST['Discipline'] == "471"){ echo "selected='selected'";} ?>>Parasitology</option>
												<option value="472" <?php if(@$_POST['Discipline'] == "472"){ echo "selected='selected'";} ?>>Particle</option>
												<option value="473" <?php if(@$_POST['Discipline'] == "473"){ echo "selected='selected'";} ?>>Particle & Plasma Physics</option>
												<option value="474" <?php if(@$_POST['Discipline'] == "474"){ echo "selected='selected'";} ?>>Particle and plasma physics</option>
												<option value="475" <?php if(@$_POST['Discipline'] == "475"){ echo "selected='selected'";} ?>>Patient-oriented research</option>
												<option value="476" <?php if(@$_POST['Discipline'] == "476"){ echo "selected='selected'";} ?>>Pediatrics & Child Health</option>
												<option value="477" <?php if(@$_POST['Discipline'] == "477"){ echo "selected='selected'";} ?>>Performing and Creative Arts</option>
												<option value="478" <?php if(@$_POST['Discipline'] == "478"){ echo "selected='selected'";} ?>>Performing arts</option>
												<option value="479" <?php if(@$_POST['Discipline'] == "479"){ echo "selected='selected'";} ?>>Petrology</option>
												<option value="480" <?php if(@$_POST['Discipline'] == "480"){ echo "selected='selected'";} ?>>Pharmaceutical Science</option>
												<option value="481" <?php if(@$_POST['Discipline'] == "481"){ echo "selected='selected'";} ?>>Pharmaceutical Sciences</option>
												<option value="482" <?php if(@$_POST['Discipline'] == "482"){ echo "selected='selected'";} ?>>Pharmacology</option>
												<option value="483" <?php if(@$_POST['Discipline'] == "483"){ echo "selected='selected'";} ?>>Pharmacology </option>
												<option value="484" <?php if(@$_POST['Discipline'] == "484"){ echo "selected='selected'";} ?>>Pharmacology & Pharmaceutical Sciences</option>
												<option value="485" <?php if(@$_POST['Discipline'] == "485"){ echo "selected='selected'";} ?>>Phenomenological Physics</option>
												<option value="486" <?php if(@$_POST['Discipline'] == "486"){ echo "selected='selected'";} ?>>Philosophy</option>
												<option value="487" <?php if(@$_POST['Discipline'] == "487"){ echo "selected='selected'";} ?>>Photography</option>
												<option value="488" <?php if(@$_POST['Discipline'] == "488"){ echo "selected='selected'";} ?>>Photonic materials</option>
												<option value="489" <?php if(@$_POST['Discipline'] == "489"){ echo "selected='selected'";} ?>>Physcial Geopraphy </option>
												<option value="490" <?php if(@$_POST['Discipline'] == "490"){ echo "selected='selected'";} ?>>Physical and Dynamic Meteorology</option>
												<option value="491" <?php if(@$_POST['Discipline'] == "491"){ echo "selected='selected'";} ?>>Physical Chemistry</option>
												<option value="492" <?php if(@$_POST['Discipline'] == "492"){ echo "selected='selected'";} ?>>Physical Geography</option>
												<option value="493" <?php if(@$_POST['Discipline'] == "493"){ echo "selected='selected'";} ?>>Physical Oceanography</option>
												<option value="494" <?php if(@$_POST['Discipline'] == "494"){ echo "selected='selected'";} ?>>Physical Sciences</option>
												<option value="495" <?php if(@$_POST['Discipline'] == "495"){ echo "selected='selected'";} ?>>Physics</option>
												<option value="496" <?php if(@$_POST['Discipline'] == "496"){ echo "selected='selected'";} ?>>Physics </option>
												<option value="497" <?php if(@$_POST['Discipline'] == "497"){ echo "selected='selected'";} ?>>Physics (other)</option>
												<option value="498" <?php if(@$_POST['Discipline'] == "498"){ echo "selected='selected'";} ?>>Physics of Living Systems</option>
												<option value="499" <?php if(@$_POST['Discipline'] == "499"){ echo "selected='selected'";} ?>>Physiology</option>
												<option value="500" <?php if(@$_POST['Discipline'] == "500"){ echo "selected='selected'";} ?>>Physiology Polymer Sciences</option>
												<option value="501" <?php if(@$_POST['Discipline'] == "501"){ echo "selected='selected'";} ?>>Phyto-chemistry</option>
												<option value="502" <?php if(@$_POST['Discipline'] == "502"){ echo "selected='selected'";} ?>>Plant Biotechnology</option>
												<option value="503" <?php if(@$_POST['Discipline'] == "503"){ echo "selected='selected'";} ?>>Plant Pathology</option>
												<option value="504" <?php if(@$_POST['Discipline'] == "504"){ echo "selected='selected'";} ?>>Plant Production</option>
												<option value="505" <?php if(@$_POST['Discipline'] == "505"){ echo "selected='selected'";} ?>>Plant Sciences</option>
												<option value="506" <?php if(@$_POST['Discipline'] == "506"){ echo "selected='selected'";} ?>>Plasma</option>
												<option value="507" <?php if(@$_POST['Discipline'] == "507"){ echo "selected='selected'";} ?>>Podiatry</option>
												<option value="508" <?php if(@$_POST['Discipline'] == "508"){ echo "selected='selected'";} ?>>Polar Science</option>
												<option value="509" <?php if(@$_POST['Discipline'] == "509"){ echo "selected='selected'";} ?>>Policy Studies</option>
												<option value="510" <?php if(@$_POST['Discipline'] == "510"){ echo "selected='selected'";} ?>>Political Sciences</option>
												<option value="511" <?php if(@$_POST['Discipline'] == "511"){ echo "selected='selected'";} ?>>Political Sciences </option>
												<option value="512" <?php if(@$_POST['Discipline'] == "512"){ echo "selected='selected'";} ?>>Political Sciences & Public Policy</option>
												<option value="513" <?php if(@$_POST['Discipline'] == "513"){ echo "selected='selected'";} ?>>Political Studies</option>
												<option value="514" <?php if(@$_POST['Discipline'] == "514"){ echo "selected='selected'";} ?>>Polymer Science</option>
												<option value="515" <?php if(@$_POST['Discipline'] == "515"){ echo "selected='selected'";} ?>>Polymer Sciences</option>
												<option value="516" <?php if(@$_POST['Discipline'] == "516"){ echo "selected='selected'";} ?>>Polymers</option>
												<option value="517" <?php if(@$_POST['Discipline'] == "517"){ echo "selected='selected'";} ?>>Power Systems Development</option>
												<option value="518" <?php if(@$_POST['Discipline'] == "518"){ echo "selected='selected'";} ?>>Private law</option>
												<option value="519" <?php if(@$_POST['Discipline'] == "519"){ echo "selected='selected'";} ?>>Probability</option>
												<option value="520" <?php if(@$_POST['Discipline'] == "520"){ echo "selected='selected'";} ?>>Process Engineering</option>
												<option value="521" <?php if(@$_POST['Discipline'] == "521"){ echo "selected='selected'";} ?>>Process Manufacturing</option>
												<option value="522" <?php if(@$_POST['Discipline'] == "522"){ echo "selected='selected'";} ?>>Proteomics</option>
												<option value="523" <?php if(@$_POST['Discipline'] == "523"){ echo "selected='selected'";} ?>>Psychiatry</option>
												<option value="524" <?php if(@$_POST['Discipline'] == "524"){ echo "selected='selected'";} ?>>Psychology</option>
												<option value="525" <?php if(@$_POST['Discipline'] == "525"){ echo "selected='selected'";} ?>>Public Administration</option>
												<option value="526" <?php if(@$_POST['Discipline'] == "526"){ echo "selected='selected'";} ?>>Public and Science Policy   </option>
												<option value="527" <?php if(@$_POST['Discipline'] == "527"){ echo "selected='selected'";} ?>>Public Health</option>
												<option value="528" <?php if(@$_POST['Discipline'] == "528"){ echo "selected='selected'";} ?>>Public law</option>
												<option value="529" <?php if(@$_POST['Discipline'] == "529"){ echo "selected='selected'";} ?>>Public Management & Administration</option>
												<option value="530" <?php if(@$_POST['Discipline'] == "530"){ echo "selected='selected'";} ?>>Public management and administration</option>
												<option value="531" <?php if(@$_POST['Discipline'] == "531"){ echo "selected='selected'";} ?>>Public Relations</option>
												<option value="532" <?php if(@$_POST['Discipline'] == "532"){ echo "selected='selected'";} ?>>Quality Management</option>
												<option value="533" <?php if(@$_POST['Discipline'] == "533"){ echo "selected='selected'";} ?>>Quantity surveying</option>
												<option value="534" <?php if(@$_POST['Discipline'] == "534"){ echo "selected='selected'";} ?>>R & D Psychology</option>
												<option value="535" <?php if(@$_POST['Discipline'] == "535"){ echo "selected='selected'";} ?>>R & D Sociology</option>
												<option value="536" <?php if(@$_POST['Discipline'] == "536"){ echo "selected='selected'";} ?>>R&D Psychology</option>
												<option value="537" <?php if(@$_POST['Discipline'] == "537"){ echo "selected='selected'";} ?>>Rehabilitation Medicine</option>
												<option value="538" <?php if(@$_POST['Discipline'] == "538"){ echo "selected='selected'";} ?>>Religion</option>
												<option value="539" <?php if(@$_POST['Discipline'] == "539"){ echo "selected='selected'";} ?>>Religious legal systems</option>
												<option value="540" <?php if(@$_POST['Discipline'] == "540"){ echo "selected='selected'";} ?>>Religious studies</option>
												<option value="541" <?php if(@$_POST['Discipline'] == "541"){ echo "selected='selected'";} ?>>Remote Sensing</option>
												<option value="542" <?php if(@$_POST['Discipline'] == "542"){ echo "selected='selected'";} ?>>Renewable Energy</option>
												<option value="543" <?php if(@$_POST['Discipline'] == "543"){ echo "selected='selected'";} ?>>Research Management</option>
												<option value="544" <?php if(@$_POST['Discipline'] == "544"){ echo "selected='selected'";} ?>>Research Management with Mathematics</option>
												<option value="545" <?php if(@$_POST['Discipline'] == "545"){ echo "selected='selected'";} ?>>Research Management, Research Support & Administration</option>
												<option value="546" <?php if(@$_POST['Discipline'] == "546"){ echo "selected='selected'";} ?>>Respiratory diseases</option>
												<option value="547" <?php if(@$_POST['Discipline'] == "547"){ echo "selected='selected'";} ?>>Rheumatology</option>
												<option value="548" <?php if(@$_POST['Discipline'] == "548"){ echo "selected='selected'";} ?>>Robotics and Computer Vision</option>
												<option value="549" <?php if(@$_POST['Discipline'] == "549"){ echo "selected='selected'";} ?>>Rural Development</option>
												<option value="550" <?php if(@$_POST['Discipline'] == "550"){ echo "selected='selected'";} ?>>Science & Statistics</option>
												<option value="551" <?php if(@$_POST['Discipline'] == "551"){ echo "selected='selected'";} ?>>Science & Technologies</option>
												<option value="552" <?php if(@$_POST['Discipline'] == "552"){ echo "selected='selected'";} ?>>Science & Technology</option>
												<option value="553" <?php if(@$_POST['Discipline'] == "553"){ echo "selected='selected'";} ?>>Science and state</option>
												<option value="554" <?php if(@$_POST['Discipline'] == "554"){ echo "selected='selected'";} ?>>Science Education</option>
												<option value="555" <?php if(@$_POST['Discipline'] == "555"){ echo "selected='selected'";} ?>>Science Education </option>
												<option value="556" <?php if(@$_POST['Discipline'] == "556"){ echo "selected='selected'";} ?>>Science Journalism</option>
												<option value="557" <?php if(@$_POST['Discipline'] == "557"){ echo "selected='selected'";} ?>>Sculpture</option>
												<option value="558" <?php if(@$_POST['Discipline'] == "558"){ echo "selected='selected'";} ?>>Sedimentary Geology</option>
												<option value="559" <?php if(@$_POST['Discipline'] == "559"){ echo "selected='selected'";} ?>>Social & Economic Geography</option>
												<option value="560" <?php if(@$_POST['Discipline'] == "560"){ echo "selected='selected'";} ?>>Social Science</option>
												<option value="561" <?php if(@$_POST['Discipline'] == "561"){ echo "selected='selected'";} ?>>Social Science and Humanities</option>
												<option value="562" <?php if(@$_POST['Discipline'] == "562"){ echo "selected='selected'";} ?>>Social Sciences</option>
												<option value="563" <?php if(@$_POST['Discipline'] == "563"){ echo "selected='selected'";} ?>>Social Sciences and Humanities</option>
												<option value="564" <?php if(@$_POST['Discipline'] == "564"){ echo "selected='selected'";} ?>>Social work</option>
												<option value="565" <?php if(@$_POST['Discipline'] == "565"){ echo "selected='selected'";} ?>>Social Work </option>
												<option value="566" <?php if(@$_POST['Discipline'] == "566"){ echo "selected='selected'";} ?>>Sociology</option>
												<option value="567" <?php if(@$_POST['Discipline'] == "567"){ echo "selected='selected'";} ?>>Software Engineering</option>
												<option value="568" <?php if(@$_POST['Discipline'] == "568"){ echo "selected='selected'";} ?>>Soil & Water  Sciences</option>
												<option value="569" <?php if(@$_POST['Discipline'] == "569"){ echo "selected='selected'";} ?>>Soil & Water Sciences</option>
												<option value="570" <?php if(@$_POST['Discipline'] == "570"){ echo "selected='selected'";} ?>>Solar Physics</option>
												<option value="571" <?php if(@$_POST['Discipline'] == "571"){ echo "selected='selected'";} ?>>Solid State</option>
												<option value="572" <?php if(@$_POST['Discipline'] == "572"){ echo "selected='selected'";} ?>>Space & Earth Science</option>
												<option value="573" <?php if(@$_POST['Discipline'] == "573"){ echo "selected='selected'";} ?>>Space and earth science</option>
												<option value="574" <?php if(@$_POST['Discipline'] == "574"){ echo "selected='selected'";} ?>>Space Science</option>
												<option value="575" <?php if(@$_POST['Discipline'] == "575"){ echo "selected='selected'";} ?>>Space Sciences</option>
												<option value="576" <?php if(@$_POST['Discipline'] == "576"){ echo "selected='selected'";} ?>>Sport Sciences</option>
												<option value="577" <?php if(@$_POST['Discipline'] == "577"){ echo "selected='selected'";} ?>>Sports & Recreational Arts</option>
												<option value="578" <?php if(@$_POST['Discipline'] == "578"){ echo "selected='selected'";} ?>>Sports & Recreational Arts </option>
												<option value="579" <?php if(@$_POST['Discipline'] == "579"){ echo "selected='selected'";} ?>>Sports Medicine</option>
												<option value="580" <?php if(@$_POST['Discipline'] == "580"){ echo "selected='selected'";} ?>>Sports Sciences</option>
												<option value="581" <?php if(@$_POST['Discipline'] == "581"){ echo "selected='selected'";} ?>>SSH (other)</option>
												<option value="582" <?php if(@$_POST['Discipline'] == "582"){ echo "selected='selected'";} ?>>Statistics</option>
												<option value="583" <?php if(@$_POST['Discipline'] == "583"){ echo "selected='selected'";} ?>>Statistics & Probability</option>
												<option value="584" <?php if(@$_POST['Discipline'] == "584"){ echo "selected='selected'";} ?>>Stem cell and regenerative biology</option>
												<option value="585" <?php if(@$_POST['Discipline'] == "585"){ echo "selected='selected'";} ?>>STEM Education and Learning Research (other)</option>
												<option value="586" <?php if(@$_POST['Discipline'] == "586"){ echo "selected='selected'";} ?>>Strategy</option>
												<option value="587" <?php if(@$_POST['Discipline'] == "587"){ echo "selected='selected'";} ?>>Structural Biology</option>
												<option value="588" <?php if(@$_POST['Discipline'] == "588"){ echo "selected='selected'";} ?>>Surgery</option>
												<option value="589" <?php if(@$_POST['Discipline'] == "589"){ echo "selected='selected'";} ?>>Sustainable Agriculture </option>
												<option value="590" <?php if(@$_POST['Discipline'] == "590"){ echo "selected='selected'";} ?>>Sustainable Chemistry</option>
												<option value="591" <?php if(@$_POST['Discipline'] == "591"){ echo "selected='selected'";} ?>>Sustainable Development</option>
												<option value="592" <?php if(@$_POST['Discipline'] == "592"){ echo "selected='selected'";} ?>>Systematics and Biodiversity</option>
												<option value="593" <?php if(@$_POST['Discipline'] == "593"){ echo "selected='selected'";} ?>>Systems and Molecular Biology</option>
												<option value="594" <?php if(@$_POST['Discipline'] == "594"){ echo "selected='selected'";} ?>>Systems Engineering</option>
												<option value="595" <?php if(@$_POST['Discipline'] == "595"){ echo "selected='selected'";} ?>>Tax law</option>
												<option value="596" <?php if(@$_POST['Discipline'] == "596"){ echo "selected='selected'";} ?>>Taxonomy</option>
												<option value="597" <?php if(@$_POST['Discipline'] == "597"){ echo "selected='selected'";} ?>>Technologies & Applied Sciences</option>
												<option value="598" <?php if(@$_POST['Discipline'] == "598"){ echo "selected='selected'";} ?>>Technologies and applied sciences</option>
												<option value="599" <?php if(@$_POST['Discipline'] == "599"){ echo "selected='selected'";} ?>>Technology Education</option>
												<option value="600" <?php if(@$_POST['Discipline'] == "600"){ echo "selected='selected'";} ?>>Tectonics</option>
												<option value="601" <?php if(@$_POST['Discipline'] == "601"){ echo "selected='selected'";} ?>>Theatre</option>
												<option value="602" <?php if(@$_POST['Discipline'] == "602"){ echo "selected='selected'";} ?>>Theology</option>
												<option value="603" <?php if(@$_POST['Discipline'] == "603"){ echo "selected='selected'";} ?>>Theology and Religion</option>
												<option value="604" <?php if(@$_POST['Discipline'] == "604"){ echo "selected='selected'";} ?>>Theoretical & Condensed Matter Physics</option>
												<option value="605" <?php if(@$_POST['Discipline'] == "605"){ echo "selected='selected'";} ?>>Theoretical Physics</option>
												<option value="606" <?php if(@$_POST['Discipline'] == "606"){ echo "selected='selected'";} ?>>Topology</option>
												<option value="607" <?php if(@$_POST['Discipline'] == "607"){ echo "selected='selected'";} ?>>Tourism</option>
												<option value="608" <?php if(@$_POST['Discipline'] == "608"){ echo "selected='selected'";} ?>>Town & Regional Planning</option>
												<option value="609" <?php if(@$_POST['Discipline'] == "609"){ echo "selected='selected'";} ?>>Toxicology</option>
												<option value="610" <?php if(@$_POST['Discipline'] == "610"){ echo "selected='selected'";} ?>>Trade and commerce</option>
												<option value="611" <?php if(@$_POST['Discipline'] == "611"){ echo "selected='selected'";} ?>>Transportation Studies</option>
												<option value="612" <?php if(@$_POST['Discipline'] == "612"){ echo "selected='selected'";} ?>>Trauma</option>
												<option value="613" <?php if(@$_POST['Discipline'] == "613"){ echo "selected='selected'";} ?>>Urban and Regional Planning</option>
												<option value="614" <?php if(@$_POST['Discipline'] == "614"){ echo "selected='selected'";} ?>>Veterinary Microbiology</option>
												<option value="615" <?php if(@$_POST['Discipline'] == "615"){ echo "selected='selected'";} ?>>Veterinary Nursing</option>
												<option value="616" <?php if(@$_POST['Discipline'] == "616"){ echo "selected='selected'";} ?>>Veterinary Science</option>
												<option value="617" <?php if(@$_POST['Discipline'] == "617"){ echo "selected='selected'";} ?>>Veterinary Sciences</option>
												<option value="618" <?php if(@$_POST['Discipline'] == "618"){ echo "selected='selected'";} ?>>Virology</option>
												<option value="622" <?php if(@$_POST['Discipline'] == "622"){ echo "selected='selected'";} ?>>Waste and Circular Economy</option>
												<option value="619" <?php if(@$_POST['Discipline'] == "619"){ echo "selected='selected'";} ?>>Waves</option>
												<option value="620" <?php if(@$_POST['Discipline'] == "620"){ echo "selected='selected'";} ?>>Wood Science </option>
												<option value="621" <?php if(@$_POST['Discipline'] == "621"){ echo "selected='selected'";} ?>>Zoology</option>
												</select>
											</fieldset>
										</div>
									</div>
									
									<div class="col-md-3 col-3" style="float:left;">
									<div class="form-group">
										<label for="Disability">Disability</label>
										<fieldset class="form-group">
											<select class="choices form-select" id="Disability" name="Disability">
												<option></option>
												<option value="Yes" <?php if(@$_POST['Disability'] == "Yes"){ echo "selected='selected'";} ?>>Yes</option>
												<option value="No" <?php if(@$_POST['Disability'] == "No"){ echo "selected='selected'";} ?>>No</option>
												
											</select>
										</fieldset>
									</div>
									</div>
									
									<div class="col-12 d-flex justify-content-end">
														<button type="submit" class="btn btn-primary me-1 mb-1" name="Submit" value="Submit">Search Applications</button>
														
                                                </div>
									</form>
											
												<table class="table table-striped" id="table1">

												<thead>
													<tr>
														<th>Reference</th>
														<th>Title</th>
														<th>Initials</th>
														<th>Surname</th>
														<th>ID/Passport Number</th>
														<th>Location</th>
														<th>Discipline</th>
														<th>Qualifications</th>
														<th>Status</th>
														<th>Disability</th>
														<th>Disability Details</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php

											if (@$_POST['Location'] != '' || @$_POST['AcademicLevel'] != '' || @$_POST['Discipline'] != '' || @$_POST['Disability'] != '') {
												$where = '';
												$FirstLocation = '';
												$SecondLocation = '';
												$ThirdLocation = '';
												$AcademicLevel = '';
												$FirstDiscipline = '';
												$SecondDiscipline = '';
												$ThirdDiscipline = '';
												$Disability = '';
												
												if(@$_POST['Location'] != ''){
													$FirstLocation = ' d.FirstProvince = "'.@$_POST['Location'].'" and ';
													$SecondLocation = ' d.SecondProvince = "'.@$_POST['Location'].'" and ';
													$ThirdLocation = ' d.ThirdProvince = "'.@$_POST['Location'].'" and ';
												}
												
												if(@$_POST['Discipline'] != ''){
													$FirstDiscipline = ' d.FirstDiscipline = "'.@$_POST['Discipline'].'" and ';
													$SecondDiscipline = ' d.SecondDiscipline = "'.@$_POST['Discipline'].'" and ';
													$ThirdDiscipline = ' d.ThirdDiscipline = "'.@$_POST['Discipline'].'" and ';
												}
												
												if(@$_POST['AcademicLevel'] != ''){
													$AcademicLevel .= ' h.AcademicLevel = "'.@$_POST['AcademicLevel'].'" AND ';
												}
												
												if(@$_POST['Disability'] != ''){
													$Disability .= ' b.Disability = "'.@$_POST['Disability'].'" AND ';
												}
												
												$where .= ' and (( '.$FirstLocation.$AcademicLevel.$FirstDiscipline.$Disability.'" 1=1") 
												 or ( '.$SecondLocation.$AcademicLevel.$SecondDiscipline.$Disability.'" 1=1")
												 or ( '.$ThirdLocation.$AcademicLevel.$ThirdDiscipline.$Disability.'" 1=1"))
												
												';
												
												
												$query = 'SELECT a.ID, b.DisabilityDetails, b.Disability, CONCAT("DSI/HSRC/2021/", a.CallID,"/", a.UserID) as Reference,z.Name as Home, c.Title, b.Initials,b.LastName,b.IDNumber,b.PassportNumber, 
												CONCAT("1st: ", e.Name, " (" , j.Name, ")", "<br />2nd: ", CASE WHEN f.Name != "" THEN f.Name ELSE "N/A" END, " (" , CASE WHEN k.Name != "" THEN k.Name ELSE "N/A" END, ")", "<br />3rd: ", CASE WHEN g.Name != "" THEN g.Name ELSE "N/A" END, " (" , CASE WHEN l.Name != "" THEN l.Name ELSE "N/A" END, ")" ) as Discipline,  
												GROUP_CONCAT(DISTINCT  CONCAT( h.NameOfDegree," (",n.Name,") - ",CASE WHEN h.Completed = "Yes" THEN "Completed" ELSE "Not Completed" END) SEPARATOR "<br />") NameOfDegree, a.Status FROM UserApplications a 
																											right join RegistrationDetails b on b.UserID = a.UserID
																											left join LookupUserTitle c on c.ID = b.TItle
																											left join PositionAppliedFor d on d.UserID = a.UserID
																											Left join LookupDisciplines e on e.ID = d.FirstDiscipline
																											Left join LookupDisciplines f on f.ID = d.SecondDiscipline
																											Left join LookupDisciplines g on g.ID = d.ThirdDiscipline
																											left join Qualifications h on h.UserID = a.UserID
																											left join LookupQualificationLevel n on n.ID = h.AcademicLevel
																
																											left join LookupProvince j on j.ID = d.FirstProvince
																											left join LookupProvince k on k.ID = d.SecondProvince
																											left join LookupProvince l on l.ID = d.ThirdProvince
																					
																											right join UserContactDetails m on m.UserID = a.UserID
																											left join LookupProvince z on z.ID = m.HomeProvince
																											WHERE a.Status not in ("Withdrawn","Interview date set","Application withdrawn") '.$where.' group by a.UserID';				
													$result = mysqli_query($conn, $query);
													//echo $query;
													while($calls = mysqli_fetch_array($result)) {
														
														echo '<tr>';
															 echo '<td>' . $calls['Reference'] . '</td>';
															 echo '<td>' . $calls['Title'] . '</td>';
															 echo '<td>' . $calls['Initials'] . '</td>';
															 echo '<td>' . $calls['LastName'] . '</td>';
															 echo '<td>' . $calls['IDNumber'].$calls['PassportNumber'] . '</td>';
															 echo '<td>' . $calls['Home'] . '</td>';
															 echo '<td>' . $calls['Discipline'] . '</td>';
															 echo '<td>' . ucwords($calls['NameOfDegree']) . '</td>';
															 if($calls['Status'] == 'Pending'){ echo '<td>Submitted to HSRC</td>'; }else{ echo '<td>' . $calls['Status']. '</td>'; }
															 echo '<td>' . $calls['Disability'] . '</td>';
															 echo '<td>' . $calls['DisabilityDetails'] . '</td>';
															 echo '<td><div class="icon dripicons-gear" data-id="'.$calls["ID"].'" data-bs-toggle="modal" modal-title="Respond to Application" data-bs-target="#primary"></div></td>';
															 
															 echo '</tr>';
														}
													}
													?>
													
												</tbody>
											</table>
							
							
			
									<form class="form">
							<!--primary theme Modal -->
                                                    <div class="modal fade text-left" id="primary" tabindex="-1"
                                                        role="dialog" aria-labelledby="myModalLabel160"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl"
                                                            role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-success">
                                                                    <h5 class="modal-title white" id="myModalLabel160">
                                                                        Review Application
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-bs-dismiss="modal" aria-label="Close">
                                                                        <i data-feather="x"></i>
                                                                    </button>
                                                                </div>
																
                                                                <div class="modal-body">
                                                                    <div class="fetched-data"></div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                        class="btn btn-light-secondary"
                                                                        data-bs-dismiss="modal">
                                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Cancel</span>
                                                                    </button>
                                                                    <button type="button" class="btn btn-primary ml-1"
                                                                         id="update">
                                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Submit</span>
                                                                    </button>
																	<a onclick="PrintScreen()">Click me</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
							

                                        </form>				
												
													
												
												
												
							
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
				
				
				
            </div>

            <?php require_once("footer.php"); ?>
        </div>
    </div>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
	
	<script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
  

    <script src="assets/js/main.js"></script>
</body>

</html>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

  <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
  
  
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script> 
<script type="text/javascript" src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> 
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script> 
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script> 
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css" />


  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
  
<script type="text/javascript" language="javascript" >
function PrintScreen() {
    var HTML_Width = $(".fetched-data").width();
    var HTML_Height = $(".fetched-data").height();
    var top_left_margin = 15;
    var PDF_Width = HTML_Width + (top_left_margin * 2);
    var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
    var canvas_image_width = HTML_Width;
    var canvas_image_height = HTML_Height;

    var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

    html2canvas($(".fetched-data")[0]).then(function (canvas) {
        var imgData = canvas.toDataURL("image/jpeg", 1.0);
        var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
        pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
        for (var i = 1; i <= totalPDFPages; i++) { 
            pdf.addPage(PDF_Width, PDF_Height);
            pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
        }
        pdf.save("application.pdf");

    });
}
 $(document).ready(function(){
	 
	 
	 

    $('#table1').DataTable( {
        dom: 'Bfrtip',
        buttons: [

            'excel', 'print'
        ]
    } );

	 

    $('#primary').on('show.bs.modal', function (e) {
       var rowid = $(e.relatedTarget).data('id');
	
	
        $.ajax({
            type : 'post',
            url : 'admin/applications/fetch.php', //Here you will fetch records 
            data :  'rowid='+ rowid, //Pass $id
            success : function(data){
            $('.fetched-data').html(data);//Show fetched data from database

			
            }
        });
		
     });
	 
	 
	 $(document).on('change', '#Status', function(){
		 if($(this).val() == 'Interview date set'){
			$('.internview-data').html('<div class="form-group"><label for="InterviewDate">Interview Date & Time <span style="color:red">*</span></label><input type="datetime-local" id="InterviewDate" name="InterviewDate" value="" class="form-control"></div>');
		 }else{
			 $('.internview-data').html('');
		 }
	 });
	 

	   $(document).on('click', '#update', function(){
		   var recordid = $('#recordid').val();
		   var UserID = $('#UserID').val();
		   var Ref = $('#Ref').val();
		   var Applicant = $('#Applicant').val();
		   var applicationid = $('#applicationid').val();
		   var MentorInstitution = $('#MentorInstitution').val();
		   var InterviewDate = $('#InterviewDate').val();
		   var Status = $('#Status').val();
		   var Options = $('#Options').val();

		   var Comments = $("#Comments").val();
		  if(Status === 'Interview date set' && $('#InterviewDate').val().length === 0){
			  alert('Please select internview date');
			  exit;
		  }

		if(MentorInstitution != null){
		   $.ajax({
			url:"admin/applications/update.php",
			method:"POST",
			data:{
				recordid:recordid,
				UserID:UserID,
				Applicant:Applicant,
				Ref:Ref,
				applicationid:applicationid,
				MentorInstitution:MentorInstitution,				
				Options:Options, 
				Status:Status, 
				Comments:Comments,
				InterviewDate:InterviewDate},
			success:function(data)
			{

				$('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
				$('#user_data').DataTable().destroy();
				location.reload();
			
			 
			}
		   });
		   
		}else{
			if(Status != null){
				alert("You are not aligned to any institution. Please make sure your institution details are correctly captured on the system.");
			}else{
				$('#primary').modal('toggle');
			}
		}
		   
   
  });
  
});	 

</script>