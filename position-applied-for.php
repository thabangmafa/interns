<?php 
include 'admin/connect.php';
$conn = OpenCon();
$menu_item = "4";
$title = "Position Applied For";

$sql = "SELECT distinct Details FROM LookupHeadings WHERE Section='Position Applied For' ";
		$result = mysqli_query($conn, $sql);
		$headings = mysqli_fetch_assoc($result);

if (isset($_POST['Submit'])) {
	
	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}
	$id = $_SESSION['id'];

	
	$FirstProvince = validate($_POST['FirstProvince']);
	$FirstDiscipline = validate($_POST['FirstDiscipline']);
	$SecondProvince = validate($_POST['SecondProvince']);
	$SecondDiscipline = validate($_POST['SecondDiscipline']);
	$ThirdProvince = validate($_POST['ThirdProvince']);
	$ThirdDiscipline = validate($_POST['ThirdDiscipline']);
	

	$query = "SELECT * FROM PositionAppliedFor WHERE UserID = '".$_SESSION['id']."'";
	$result = mysqli_query($conn, $query);
	if (mysqli_num_rows($result) === 0) {
	
	$sql2 = "INSERT INTO PositionAppliedFor(
						UserID,
						
						FirstProvince,
						FirstDiscipline,
						SecondProvince,
						SecondDiscipline,
						ThirdProvince,
						ThirdDiscipline
) VALUES(
						'$id',
						
						'$FirstProvince',
						'$FirstDiscipline',
						'$SecondProvince',
						'$SecondDiscipline',
						'$ThirdProvince',
						'$ThirdDiscipline'

)";


    $result2 = mysqli_query($conn, $sql2);
	$message = "Details successfully captured.";
	$checklist = "INSERT INTO ApplicantChecklist(UserID, Section)VALUES('$id','Position Applied For')";
		mysqli_query($conn, $checklist);
	unset($_POST);
	}else{
		
	$sql2 = "UPDATE PositionAppliedFor SET 
	
						FirstProvince = '$FirstProvince',
						FirstDiscipline = '$FirstDiscipline',
						SecondProvince = '$SecondProvince',
						SecondDiscipline = '$SecondDiscipline',
						ThirdProvince = '$ThirdProvince',
						ThirdDiscipline = '$ThirdDiscipline'
							
	WHERE UserID = '".$id."'";

	$result2 = mysqli_query($conn, $sql2);
	$message = "Details successfully updated.";
	unset($_POST);	
	}
	
}

	$query = "SELECT a.ID, a.UserID, a.FirstProvince, a.SecondProvince, a.ThirdProvince, a.FirstDiscipline, a.SecondDiscipline, a.ThirdDiscipline FROM `PositionAppliedFor` a 
left join LookupProvince b on b.ID = a.FirstProvince 
left join LookupProvince c on c.ID = a.SecondProvince 
left join LookupProvince d on d.ID = a.ThirdProvince
	WHERE a.UserID = '".$_SESSION['id']."'";
	$result = mysqli_query($conn, $query);

	while($userdetails = mysqli_fetch_array($result)) {

			$FirstProvince = $userdetails['FirstProvince'];
			$FirstDiscipline = $userdetails['FirstDiscipline'];
			$SecondProvince = $userdetails['SecondProvince'];
			$SecondDiscipline = $userdetails['SecondDiscipline'];
			$ThirdProvince = $userdetails['ThirdProvince'];
			$ThirdDiscipline = $userdetails['ThirdDiscipline'];
			
	}
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
								<?php echo $headings['Details']; ?>
                                    
                                </div>
                                <div class="card-content">
								<?php if(@$message){ ?>	
								<div class="alert alert-success" role="alert"><?php echo @$message; ?></div>
								<?php } ?>
                                    <div class="card-body">
									<div class="row">
                                        <form class="form" method="POST" action="">
                                            <div class="row">
												
												<h5 class="divider divider-left">
                                        <div class="divider-text">Option 1:</div>
                                    </h5>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="FirstProvince">Province <span style="color:red">*</span></label>
                                                        <fieldset class="form-group">
                                                    <select class="choices form-select" id="FirstProvince" name="FirstProvince" required="required">
                                                        <option></option>
                                                        <option value="1" <?php if(@$FirstProvince == "1"){ echo "selected='selected'";} ?>>Gauteng</option>
<option value="2" <?php if(@$FirstProvince == "2"){ echo "selected='selected'";} ?>>Free State</option>
<option value="3" <?php if(@$FirstProvince == "3"){ echo "selected='selected'";} ?>>Eastern Cape</option>
<option value="4" <?php if(@$FirstProvince == "4"){ echo "selected='selected'";} ?>>KwaZulu-Natal</option>
<option value="5" <?php if(@$FirstProvince == "5"){ echo "selected='selected'";} ?>>Limpopo</option>
<option value="6" <?php if(@$FirstProvince == "6"){ echo "selected='selected'";} ?>>Mpumalanga</option>
<option value="7" <?php if(@$FirstProvince == "7"){ echo "selected='selected'";} ?>>Northern Cape</option>
<option value="8" <?php if(@$FirstProvince == "8"){ echo "selected='selected'";} ?>>North West</option>
<option value="9" <?php if(@$FirstProvince == "9"){ echo "selected='selected'";} ?>>Western Cape</option>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="FirstDiscipline">Discipline/Area of Specialisation <span style="color:red">*</span></label>
                                                        <fieldset class="form-group">
                                                    <select class="choices form-select" id="FirstDiscipline" name="FirstDiscipline" required="required">
													<option></option>
<option value="27" <?php if(@$FirstDiscipline == "27"){ echo "selected='selected'";} ?>>Accounting</option>
<option value="28" <?php if(@$FirstDiscipline == "28"){ echo "selected='selected'";} ?>>Accounting and finance</option>
<option value="29" <?php if(@$FirstDiscipline == "29"){ echo "selected='selected'";} ?>>Accounting science</option>
<option value="30" <?php if(@$FirstDiscipline == "30"){ echo "selected='selected'";} ?>>Actuarial Science</option>
<option value="31" <?php if(@$FirstDiscipline == "31"){ echo "selected='selected'";} ?>>Acturial science</option>
<option value="32" <?php if(@$FirstDiscipline == "32"){ echo "selected='selected'";} ?>>additive manufacturing</option>
<option value="33" <?php if(@$FirstDiscipline == "33"){ echo "selected='selected'";} ?>>Administration</option>
<option value="34" <?php if(@$FirstDiscipline == "34"){ echo "selected='selected'";} ?>>Aeronautical and Aerospace</option>
<option value="35" <?php if(@$FirstDiscipline == "35"){ echo "selected='selected'";} ?>>Aeronomy</option>
<option value="36" <?php if(@$FirstDiscipline == "36"){ echo "selected='selected'";} ?>>Aerospace & Aeronautical Engineering</option>
<option value="37" <?php if(@$FirstDiscipline == "37"){ echo "selected='selected'";} ?>>African Languages</option>
<option value="38" <?php if(@$FirstDiscipline == "38"){ echo "selected='selected'";} ?>>AGRI (other)</option>
<option value="39" <?php if(@$FirstDiscipline == "39"){ echo "selected='selected'";} ?>>Agribusiness</option>
<option value="40" <?php if(@$FirstDiscipline == "40"){ echo "selected='selected'";} ?>>Agricultural Biotechnology</option>
<option value="41" <?php if(@$FirstDiscipline == "41"){ echo "selected='selected'";} ?>>Agricultural Economics</option>
<option value="42" <?php if(@$FirstDiscipline == "42"){ echo "selected='selected'";} ?>>Agricultural Engineering</option>
<option value="43" <?php if(@$FirstDiscipline == "43"){ echo "selected='selected'";} ?>>Agricultural Extension</option>
<option value="44" <?php if(@$FirstDiscipline == "44"){ echo "selected='selected'";} ?>>Agricultural Management</option>
<option value="45" <?php if(@$FirstDiscipline == "45"){ echo "selected='selected'";} ?>>Agricultural Resource Management</option>
<option value="46" <?php if(@$FirstDiscipline == "46"){ echo "selected='selected'";} ?>>Agricultural Sciences</option>
<option value="47" <?php if(@$FirstDiscipline == "47"){ echo "selected='selected'";} ?>>Agriculture</option>
<option value="48" <?php if(@$FirstDiscipline == "48"){ echo "selected='selected'";} ?>>Agriculture Economics</option>
<option value="49" <?php if(@$FirstDiscipline == "49"){ echo "selected='selected'";} ?>>Agriculture Education </option>
<option value="50" <?php if(@$FirstDiscipline == "50"){ echo "selected='selected'";} ?>>Agrometeorology</option>
<option value="51" <?php if(@$FirstDiscipline == "51"){ echo "selected='selected'";} ?>>Agrometereology</option>
<option value="52" <?php if(@$FirstDiscipline == "52"){ echo "selected='selected'";} ?>>Agroprocessing</option>
<option value="53" <?php if(@$FirstDiscipline == "53"){ echo "selected='selected'";} ?>>Algebra, Number Theory, and Combinatorics</option>
<option value="54" <?php if(@$FirstDiscipline == "54"){ echo "selected='selected'";} ?>>Algorithms and Theoretical Foundations</option>
<option value="55" <?php if(@$FirstDiscipline == "55"){ echo "selected='selected'";} ?>>Anaesthesia & Pain Management</option>
<option value="56" <?php if(@$FirstDiscipline == "56"){ echo "selected='selected'";} ?>>Anaesthesia and pain management</option>
<option value="57" <?php if(@$FirstDiscipline == "57"){ echo "selected='selected'";} ?>>Analysis</option>
<option value="58" <?php if(@$FirstDiscipline == "58"){ echo "selected='selected'";} ?>>Analytical Chemistry</option>
<option value="59" <?php if(@$FirstDiscipline == "59"){ echo "selected='selected'";} ?>>Anatomical pathology</option>
<option value="60" <?php if(@$FirstDiscipline == "60"){ echo "selected='selected'";} ?>>Anatomical Sciences</option>
<option value="61" <?php if(@$FirstDiscipline == "61"){ echo "selected='selected'";} ?>>Animal and Veterinary Sciences</option>
<option value="62" <?php if(@$FirstDiscipline == "62"){ echo "selected='selected'";} ?>>Animal Breeding & Genetics</option>
<option value="63" <?php if(@$FirstDiscipline == "63"){ echo "selected='selected'";} ?>>Animal Diseases</option>
<option value="64" <?php if(@$FirstDiscipline == "64"){ echo "selected='selected'";} ?>>Animal parasitology</option>
<option value="65" <?php if(@$FirstDiscipline == "65"){ echo "selected='selected'";} ?>>Animal Production</option>
<option value="66" <?php if(@$FirstDiscipline == "66"){ echo "selected='selected'";} ?>>Animal Science</option>
<option value="67" <?php if(@$FirstDiscipline == "67"){ echo "selected='selected'";} ?>>Anthropology</option>
<option value="68" <?php if(@$FirstDiscipline == "68"){ echo "selected='selected'";} ?>>Applied Mathematics</option>
<option value="69" <?php if(@$FirstDiscipline == "69"){ echo "selected='selected'";} ?>>Archaeology</option>
<option value="70" <?php if(@$FirstDiscipline == "70"){ echo "selected='selected'";} ?>>Architecture</option>
<option value="71" <?php if(@$FirstDiscipline == "71"){ echo "selected='selected'";} ?>>Argriculture </option>
<option value="72" <?php if(@$FirstDiscipline == "72"){ echo "selected='selected'";} ?>>Argrometereology</option>
<option value="73" <?php if(@$FirstDiscipline == "73"){ echo "selected='selected'";} ?>>Artifical Intelligence</option>
<option value="74" <?php if(@$FirstDiscipline == "74"){ echo "selected='selected'";} ?>>Artificial intelligence</option>
<option value="75" <?php if(@$FirstDiscipline == "75"){ echo "selected='selected'";} ?>>Arts</option>
<option value="76" <?php if(@$FirstDiscipline == "76"){ echo "selected='selected'";} ?>>Astronomy</option>
<option value="77" <?php if(@$FirstDiscipline == "77"){ echo "selected='selected'";} ?>>Astrophysics</option>
<option value="78" <?php if(@$FirstDiscipline == "78"){ echo "selected='selected'";} ?>>Atmospheric Chemistry</option>
<option value="79" <?php if(@$FirstDiscipline == "79"){ echo "selected='selected'";} ?>>Atmospheric Science & Meteorology</option>
<option value="80" <?php if(@$FirstDiscipline == "80"){ echo "selected='selected'";} ?>>Atomic and Molecular</option>
<option value="81" <?php if(@$FirstDiscipline == "81"){ echo "selected='selected'";} ?>>Atomic, Molecular & Nuclear Physics</option>
<option value="82" <?php if(@$FirstDiscipline == "82"){ echo "selected='selected'";} ?>>Atomic, Molecular, Nuclear Physics</option>
<option value="83" <?php if(@$FirstDiscipline == "83"){ echo "selected='selected'";} ?>>Auditing</option>
<option value="84" <?php if(@$FirstDiscipline == "84"){ echo "selected='selected'";} ?>>Automotive Engineering</option>
<option value="85" <?php if(@$FirstDiscipline == "85"){ echo "selected='selected'";} ?>>Basic and Applied Microbiology</option>
<option value="86" <?php if(@$FirstDiscipline == "86"){ echo "selected='selected'";} ?>>Basic Medical Science</option>
<option value="87" <?php if(@$FirstDiscipline == "87"){ echo "selected='selected'";} ?>>Biochemistry</option>
<option value="88" <?php if(@$FirstDiscipline == "88"){ echo "selected='selected'";} ?>>Bioengineering</option>
<option value="89" <?php if(@$FirstDiscipline == "89"){ echo "selected='selected'";} ?>>Bio-engineering</option>
<option value="90" <?php if(@$FirstDiscipline == "90"){ echo "selected='selected'";} ?>>Biogeochemistry</option>
<option value="91" <?php if(@$FirstDiscipline == "91"){ echo "selected='selected'";} ?>>Bioinformatics</option>
<option value="92" <?php if(@$FirstDiscipline == "92"){ echo "selected='selected'";} ?>>Bioinformatics and Computational Biology</option>
<option value="93" <?php if(@$FirstDiscipline == "93"){ echo "selected='selected'";} ?>>Bioinformatics and other Informatics</option>
<option value="94" <?php if(@$FirstDiscipline == "94"){ echo "selected='selected'";} ?>>Biological Oceanography</option>
<option value="95" <?php if(@$FirstDiscipline == "95"){ echo "selected='selected'";} ?>>Biological science</option>
<option value="96" <?php if(@$FirstDiscipline == "96"){ echo "selected='selected'";} ?>>Biological Sciences</option>
<option value="97" <?php if(@$FirstDiscipline == "97"){ echo "selected='selected'";} ?>>Biology</option>
<option value="98" <?php if(@$FirstDiscipline == "98"){ echo "selected='selected'";} ?>>Biomaterials</option>
<option value="99" <?php if(@$FirstDiscipline == "99"){ echo "selected='selected'";} ?>>Biomedical Technology</option>
<option value="100" <?php if(@$FirstDiscipline == "100"){ echo "selected='selected'";} ?>>Biometrics</option>
<option value="101" <?php if(@$FirstDiscipline == "101"){ echo "selected='selected'";} ?>>Biophysics</option>
<option value="102" <?php if(@$FirstDiscipline == "102"){ echo "selected='selected'";} ?>>Bioprocesses</option>
<option value="103" <?php if(@$FirstDiscipline == "103"){ echo "selected='selected'";} ?>>Biostatistics</option>
<option value="104" <?php if(@$FirstDiscipline == "104"){ echo "selected='selected'";} ?>>Biotechnology</option>
<option value="105" <?php if(@$FirstDiscipline == "105"){ echo "selected='selected'";} ?>>Botany</option>
<option value="106" <?php if(@$FirstDiscipline == "106"){ echo "selected='selected'";} ?>>Business administration</option>
<option value="107" <?php if(@$FirstDiscipline == "107"){ echo "selected='selected'";} ?>>Business economics</option>
<option value="108" <?php if(@$FirstDiscipline == "108"){ echo "selected='selected'";} ?>>Business Sciences </option>
<option value="109" <?php if(@$FirstDiscipline == "109"){ echo "selected='selected'";} ?>>Capital Markets and Investments</option>
<option value="110" <?php if(@$FirstDiscipline == "110"){ echo "selected='selected'";} ?>>Cardiology</option>
<option value="111" <?php if(@$FirstDiscipline == "111"){ echo "selected='selected'";} ?>>Cardiovascular diseases</option>
<option value="112" <?php if(@$FirstDiscipline == "112"){ echo "selected='selected'";} ?>>Cell Biology</option>
<option value="113" <?php if(@$FirstDiscipline == "113"){ echo "selected='selected'";} ?>>Cellular and Molecular Biology</option>
<option value="114" <?php if(@$FirstDiscipline == "114"){ echo "selected='selected'";} ?>>Ceramics</option>
<option value="115" <?php if(@$FirstDiscipline == "115"){ echo "selected='selected'";} ?>>Chemical Catalysis</option>
<option value="116" <?php if(@$FirstDiscipline == "116"){ echo "selected='selected'";} ?>>Chemical Engineering</option>
<option value="117" <?php if(@$FirstDiscipline == "117"){ echo "selected='selected'";} ?>>Chemical Measurement and Imaging</option>
<option value="118" <?php if(@$FirstDiscipline == "118"){ echo "selected='selected'";} ?>>Chemical Oceanography</option>
<option value="119" <?php if(@$FirstDiscipline == "119"){ echo "selected='selected'";} ?>>Chemical Pathology</option>
<option value="120" <?php if(@$FirstDiscipline == "120"){ echo "selected='selected'";} ?>>Chemical Sciences</option>
<option value="121" <?php if(@$FirstDiscipline == "121"){ echo "selected='selected'";} ?>>Chemical Structure, Dynamics, and Mechanism</option>
<option value="122" <?php if(@$FirstDiscipline == "122"){ echo "selected='selected'";} ?>>Chemical Synthesis</option>
<option value="123" <?php if(@$FirstDiscipline == "123"){ echo "selected='selected'";} ?>>Chemical Theory, Models and Computational Methods</option>
<option value="124" <?php if(@$FirstDiscipline == "124"){ echo "selected='selected'";} ?>>Chemistry</option>
<option value="125" <?php if(@$FirstDiscipline == "125"){ echo "selected='selected'";} ?>>Chemistry of Life Processes</option>
<option value="126" <?php if(@$FirstDiscipline == "126"){ echo "selected='selected'";} ?>>Chemistry of materials</option>
<option value="127" <?php if(@$FirstDiscipline == "127"){ echo "selected='selected'";} ?>>Chemistry Sciences Engineering</option>
<option value="128" <?php if(@$FirstDiscipline == "128"){ echo "selected='selected'";} ?>>Circuits</option>
<option value="129" <?php if(@$FirstDiscipline == "129"){ echo "selected='selected'";} ?>>Civil Engineering</option>
<option value="130" <?php if(@$FirstDiscipline == "130"){ echo "selected='selected'";} ?>>Civil procedure and courts</option>
<option value="131" <?php if(@$FirstDiscipline == "131"){ echo "selected='selected'";} ?>>Classics</option>
<option value="132" <?php if(@$FirstDiscipline == "132"){ echo "selected='selected'";} ?>>Climate and Large-Scale Atmospheric Dynamics</option>
<option value="133" <?php if(@$FirstDiscipline == "133"){ echo "selected='selected'";} ?>>Climate Change</option>
<option value="134" <?php if(@$FirstDiscipline == "134"){ echo "selected='selected'";} ?>>Clinical medicine</option>
<option value="135" <?php if(@$FirstDiscipline == "135"){ echo "selected='selected'";} ?>>Collections Management</option>
<option value="136" <?php if(@$FirstDiscipline == "136"){ echo "selected='selected'";} ?>>Commercial Law</option>
<option value="137" <?php if(@$FirstDiscipline == "137"){ echo "selected='selected'";} ?>>Communication</option>
<option value="138" <?php if(@$FirstDiscipline == "138"){ echo "selected='selected'";} ?>>Communication & Media Studies</option>
<option value="139" <?php if(@$FirstDiscipline == "139"){ echo "selected='selected'";} ?>>Communication and Information Theory</option>
<option value="140" <?php if(@$FirstDiscipline == "140"){ echo "selected='selected'";} ?>>Communication Technology</option>
<option value="141" <?php if(@$FirstDiscipline == "141"){ echo "selected='selected'";} ?>>Comparative Law</option>
<option value="142" <?php if(@$FirstDiscipline == "142"){ echo "selected='selected'";} ?>>Computational and Data-enabled Science</option>
<option value="143" <?php if(@$FirstDiscipline == "143"){ echo "selected='selected'";} ?>>Computational Mathematics</option>
<option value="144" <?php if(@$FirstDiscipline == "144"){ echo "selected='selected'";} ?>>Computational Science and Engineering</option>
<option value="145" <?php if(@$FirstDiscipline == "145"){ echo "selected='selected'";} ?>>Computational Statistics</option>
<option value="146" <?php if(@$FirstDiscipline == "146"){ echo "selected='selected'";} ?>>Computer Architecture</option>
<option value="147" <?php if(@$FirstDiscipline == "147"){ echo "selected='selected'";} ?>>Computer Engineering</option>
<option value="148" <?php if(@$FirstDiscipline == "148"){ echo "selected='selected'";} ?>>Computer Hardware</option>
<option value="149" <?php if(@$FirstDiscipline == "149"){ echo "selected='selected'";} ?>>Computer multimedia systems</option>
<option value="150" <?php if(@$FirstDiscipline == "150"){ echo "selected='selected'";} ?>>Computer Networks</option>
<option value="151" <?php if(@$FirstDiscipline == "151"){ echo "selected='selected'";} ?>>Computer Programming</option>
<option value="152" <?php if(@$FirstDiscipline == "152"){ echo "selected='selected'";} ?>>Computer Science and Information Systems</option>
<option value="153" <?php if(@$FirstDiscipline == "153"){ echo "selected='selected'";} ?>>Computer Security and Privacy</option>
<option value="154" <?php if(@$FirstDiscipline == "154"){ echo "selected='selected'";} ?>>Computer Software</option>
<option value="155" <?php if(@$FirstDiscipline == "155"){ echo "selected='selected'";} ?>>Computer Systems and Embedded Systems</option>
<option value="156" <?php if(@$FirstDiscipline == "156"){ echo "selected='selected'";} ?>>Condensed Matter</option>
<option value="157" <?php if(@$FirstDiscipline == "157"){ echo "selected='selected'";} ?>>Constitutional and administrative law</option>
<option value="158" <?php if(@$FirstDiscipline == "158"){ echo "selected='selected'";} ?>>Construction & Building</option>
<option value="159" <?php if(@$FirstDiscipline == "159"){ echo "selected='selected'";} ?>>Construction Industry & Building</option>
<option value="160" <?php if(@$FirstDiscipline == "160"){ echo "selected='selected'";} ?>>Construction industry and building</option>
<option value="161" <?php if(@$FirstDiscipline == "161"){ echo "selected='selected'";} ?>>Corporate governance</option>
<option value="162" <?php if(@$FirstDiscipline == "162"){ echo "selected='selected'";} ?>>Creative Arts</option>
<option value="163" <?php if(@$FirstDiscipline == "163"){ echo "selected='selected'";} ?>>Criminal law</option>
<option value="164" <?php if(@$FirstDiscipline == "164"){ echo "selected='selected'";} ?>>Criminology</option>
<option value="165" <?php if(@$FirstDiscipline == "165"){ echo "selected='selected'";} ?>>CRM (other)</option>
<option value="166" <?php if(@$FirstDiscipline == "166"){ echo "selected='selected'";} ?>>Cultural studies</option>
<option value="167" <?php if(@$FirstDiscipline == "167"){ echo "selected='selected'";} ?>>Customary law</option>
<option value="168" <?php if(@$FirstDiscipline == "168"){ echo "selected='selected'";} ?>>Dairy Science</option>
<option value="169" <?php if(@$FirstDiscipline == "169"){ echo "selected='selected'";} ?>>Data Mining and Information Retrieval</option>
<option value="170" <?php if(@$FirstDiscipline == "170"){ echo "selected='selected'";} ?>>Databases</option>
<option value="171" <?php if(@$FirstDiscipline == "171"){ echo "selected='selected'";} ?>>Decorative arts</option>
<option value="172" <?php if(@$FirstDiscipline == "172"){ echo "selected='selected'";} ?>>Degenerative diseases</option>
<option value="173" <?php if(@$FirstDiscipline == "173"){ echo "selected='selected'";} ?>>Demography</option>
<option value="174" <?php if(@$FirstDiscipline == "174"){ echo "selected='selected'";} ?>>Dental Sciences</option>
<option value="175" <?php if(@$FirstDiscipline == "175"){ echo "selected='selected'";} ?>>Dermatology</option>
<option value="176" <?php if(@$FirstDiscipline == "176"){ echo "selected='selected'";} ?>>Design studies</option>
<option value="177" <?php if(@$FirstDiscipline == "177"){ echo "selected='selected'";} ?>>Development Studies</option>
<option value="178" <?php if(@$FirstDiscipline == "178"){ echo "selected='selected'";} ?>>Developmental Biology</option>
<option value="179" <?php if(@$FirstDiscipline == "179"){ echo "selected='selected'";} ?>>Developmental Studies</option>
<option value="180" <?php if(@$FirstDiscipline == "180"){ echo "selected='selected'";} ?>>Diabetology</option>
<option value="181" <?php if(@$FirstDiscipline == "181"){ echo "selected='selected'";} ?>>Dietetics</option>
<option value="182" <?php if(@$FirstDiscipline == "182"){ echo "selected='selected'";} ?>>Dietetics </option>
<option value="183" <?php if(@$FirstDiscipline == "183"){ echo "selected='selected'";} ?>>Diffusion</option>
<option value="184" <?php if(@$FirstDiscipline == "184"){ echo "selected='selected'";} ?>>Dramatic arts</option>
<option value="185" <?php if(@$FirstDiscipline == "185"){ echo "selected='selected'";} ?>>Drug discovery</option>
<option value="186" <?php if(@$FirstDiscipline == "186"){ echo "selected='selected'";} ?>>Drug Discovery and Development</option>
<option value="187" <?php if(@$FirstDiscipline == "187"){ echo "selected='selected'";} ?>>Earth and Related Environmental sciences</option>
<option value="188" <?php if(@$FirstDiscipline == "188"){ echo "selected='selected'";} ?>>Earth Observation</option>
<option value="189" <?php if(@$FirstDiscipline == "189"){ echo "selected='selected'";} ?>>Earth Science</option>
<option value="190" <?php if(@$FirstDiscipline == "190"){ echo "selected='selected'";} ?>>Earth Sciences</option>
<option value="191" <?php if(@$FirstDiscipline == "191"){ echo "selected='selected'";} ?>>Ecology</option>
<option value="192" <?php if(@$FirstDiscipline == "192"){ echo "selected='selected'";} ?>>Ecology & Env Science</option>
<option value="193" <?php if(@$FirstDiscipline == "193"){ echo "selected='selected'";} ?>>Ecology & Enviromental Science</option>
<option value="194" <?php if(@$FirstDiscipline == "194"){ echo "selected='selected'";} ?>>Ecology & Environmental Science</option>
<option value="195" <?php if(@$FirstDiscipline == "195"){ echo "selected='selected'";} ?>>Ecology & Environmental Sciences</option>
<option value="196" <?php if(@$FirstDiscipline == "196"){ echo "selected='selected'";} ?>>Economic Sciences</option>
<option value="197" <?php if(@$FirstDiscipline == "197"){ echo "selected='selected'";} ?>>Economics</option>
<option value="198" <?php if(@$FirstDiscipline == "198"){ echo "selected='selected'";} ?>>Education</option>
<option value="199" <?php if(@$FirstDiscipline == "199"){ echo "selected='selected'";} ?>>Education </option>
<option value="200" <?php if(@$FirstDiscipline == "200"){ echo "selected='selected'";} ?>>Elasticity</option>
<option value="201" <?php if(@$FirstDiscipline == "201"){ echo "selected='selected'";} ?>>Electrical Engineering</option>
<option value="202" <?php if(@$FirstDiscipline == "202"){ echo "selected='selected'";} ?>>Electromagnetism</option>
<option value="203" <?php if(@$FirstDiscipline == "203"){ echo "selected='selected'";} ?>>Electronic Engineering</option>
<option value="204" <?php if(@$FirstDiscipline == "204"){ echo "selected='selected'";} ?>>Electronic materials</option>
<option value="205" <?php if(@$FirstDiscipline == "205"){ echo "selected='selected'";} ?>>Electronics Engineering</option>
<option value="206" <?php if(@$FirstDiscipline == "206"){ echo "selected='selected'";} ?>>EMAS (other)</option>
<option value="207" <?php if(@$FirstDiscipline == "207"){ echo "selected='selected'";} ?>>Embryology & Fetal Development</option>
<option value="208" <?php if(@$FirstDiscipline == "208"){ echo "selected='selected'";} ?>>Endocrinology</option>
<option value="209" <?php if(@$FirstDiscipline == "209"){ echo "selected='selected'";} ?>>Energy</option>
<option value="210" <?php if(@$FirstDiscipline == "210"){ echo "selected='selected'";} ?>>Energy Efficiency</option>
<option value="211" <?php if(@$FirstDiscipline == "211"){ echo "selected='selected'";} ?>>ENG (other)</option>
<option value="212" <?php if(@$FirstDiscipline == "212"){ echo "selected='selected'";} ?>>Engineering</option>
<option value="213" <?php if(@$FirstDiscipline == "213"){ echo "selected='selected'";} ?>>Engineering Education</option>
<option value="214" <?php if(@$FirstDiscipline == "214"){ echo "selected='selected'";} ?>>Engineering Management</option>
<option value="215" <?php if(@$FirstDiscipline == "215"){ echo "selected='selected'";} ?>>Engineering Sciences</option>
<option value="216" <?php if(@$FirstDiscipline == "216"){ echo "selected='selected'";} ?>>Entomology</option>
<option value="217" <?php if(@$FirstDiscipline == "217"){ echo "selected='selected'";} ?>>Enviromental Engineering</option>
<option value="218" <?php if(@$FirstDiscipline == "218"){ echo "selected='selected'";} ?>>Enviromental Studies</option>
<option value="219" <?php if(@$FirstDiscipline == "219"){ echo "selected='selected'";} ?>>Environment</option>
<option value="220" <?php if(@$FirstDiscipline == "220"){ echo "selected='selected'";} ?>>Environment Sciences</option>
<option value="221" <?php if(@$FirstDiscipline == "221"){ echo "selected='selected'";} ?>>Environmental and Earth Sciences</option>
<option value="222" <?php if(@$FirstDiscipline == "222"){ echo "selected='selected'";} ?>>Environmental Biology</option>
<option value="223" <?php if(@$FirstDiscipline == "223"){ echo "selected='selected'";} ?>>Environmental biotechnology</option>
<option value="224" <?php if(@$FirstDiscipline == "224"){ echo "selected='selected'";} ?>>Environmental Chemical Systems</option>
<option value="225" <?php if(@$FirstDiscipline == "225"){ echo "selected='selected'";} ?>>Environmental Engineering</option>
<option value="226" <?php if(@$FirstDiscipline == "226"){ echo "selected='selected'";} ?>>Environmental Health</option>
<option value="227" <?php if(@$FirstDiscipline == "227"){ echo "selected='selected'";} ?>>Environmental Health </option>
<option value="228" <?php if(@$FirstDiscipline == "228"){ echo "selected='selected'";} ?>>Environmental Sciences</option>
<option value="229" <?php if(@$FirstDiscipline == "229"){ echo "selected='selected'";} ?>>Environmental Studies</option>
<option value="230" <?php if(@$FirstDiscipline == "230"){ echo "selected='selected'";} ?>>Epidemiology</option>
<option value="231" <?php if(@$FirstDiscipline == "231"){ echo "selected='selected'";} ?>>Epidemiology </option>
<option value="232" <?php if(@$FirstDiscipline == "232"){ echo "selected='selected'";} ?>>Epidemiology, incl. burden of disease</option>
<option value="233" <?php if(@$FirstDiscipline == "233"){ echo "selected='selected'";} ?>>Ergonomics and Sports science</option>
<option value="234" <?php if(@$FirstDiscipline == "234"){ echo "selected='selected'";} ?>>Ethics</option>
<option value="235" <?php if(@$FirstDiscipline == "235"){ echo "selected='selected'";} ?>>Evolution and developmental biology</option>
<option value="236" <?php if(@$FirstDiscipline == "236"){ echo "selected='selected'";} ?>>Evolutionary Biology</option>
<option value="237" <?php if(@$FirstDiscipline == "237"){ echo "selected='selected'";} ?>>Financial Management</option>
<option value="238" <?php if(@$FirstDiscipline == "238"){ echo "selected='selected'";} ?>>Fine arts</option>
<option value="239" <?php if(@$FirstDiscipline == "239"){ echo "selected='selected'";} ?>>Fisheries</option>
<option value="240" <?php if(@$FirstDiscipline == "240"){ echo "selected='selected'";} ?>>Fisheries </option>
<option value="241" <?php if(@$FirstDiscipline == "241"){ echo "selected='selected'";} ?>>Fluids  </option>
<option value="242" <?php if(@$FirstDiscipline == "242"){ echo "selected='selected'";} ?>>Food Science & Technology</option>
<option value="243" <?php if(@$FirstDiscipline == "243"){ echo "selected='selected'";} ?>>Food Sciences & Technologies</option>
<option value="244" <?php if(@$FirstDiscipline == "244"){ echo "selected='selected'";} ?>>Food Sciences & Technology</option>
<option value="245" <?php if(@$FirstDiscipline == "245"){ echo "selected='selected'";} ?>>Food sciences and technology</option>
<option value="246" <?php if(@$FirstDiscipline == "246"){ echo "selected='selected'";} ?>>Food Technology</option>
<option value="247" <?php if(@$FirstDiscipline == "247"){ echo "selected='selected'";} ?>>Forensic Sciences</option>
<option value="248" <?php if(@$FirstDiscipline == "248"){ echo "selected='selected'";} ?>>Forest Science</option>
<option value="249" <?php if(@$FirstDiscipline == "249"){ echo "selected='selected'";} ?>>Forestry</option>
<option value="250" <?php if(@$FirstDiscipline == "250"){ echo "selected='selected'";} ?>>Formal Methods, Verification, and Programming Languages</option>
<option value="251" <?php if(@$FirstDiscipline == "251"){ echo "selected='selected'";} ?>>Fresh Water Biology</option>
<option value="252" <?php if(@$FirstDiscipline == "252"){ echo "selected='selected'";} ?>>Fresh Water Biology & Limnology</option>
<option value="253" <?php if(@$FirstDiscipline == "253"){ echo "selected='selected'";} ?>>Functional Genomics</option>
<option value="254" <?php if(@$FirstDiscipline == "254"){ echo "selected='selected'";} ?>>Game Ranching & Farming</option>
<option value="255" <?php if(@$FirstDiscipline == "255"){ echo "selected='selected'";} ?>>Game ranching and farming</option>
<option value="256" <?php if(@$FirstDiscipline == "256"){ echo "selected='selected'";} ?>>Gastrointestinal diseases</option>
<option value="257" <?php if(@$FirstDiscipline == "257"){ echo "selected='selected'";} ?>>General practice</option>
<option value="258" <?php if(@$FirstDiscipline == "258"){ echo "selected='selected'";} ?>>Genetics</option>
<option value="259" <?php if(@$FirstDiscipline == "259"){ echo "selected='selected'";} ?>>Genito-urinary diseases (incl. Urology)</option>
<option value="260" <?php if(@$FirstDiscipline == "260"){ echo "selected='selected'";} ?>>Genomic biology</option>
<option value="261" <?php if(@$FirstDiscipline == "261"){ echo "selected='selected'";} ?>>Genomics</option>
<option value="262" <?php if(@$FirstDiscipline == "262"){ echo "selected='selected'";} ?>>Geobiology</option>
<option value="263" <?php if(@$FirstDiscipline == "263"){ echo "selected='selected'";} ?>>Geochemistry</option>
<option value="264" <?php if(@$FirstDiscipline == "264"){ echo "selected='selected'";} ?>>Geodynamics</option>
<option value="265" <?php if(@$FirstDiscipline == "265"){ echo "selected='selected'";} ?>>Geographic Information Science</option>
<option value="266" <?php if(@$FirstDiscipline == "266"){ echo "selected='selected'";} ?>>Geographic Information Systems</option>
<option value="267" <?php if(@$FirstDiscipline == "267"){ echo "selected='selected'";} ?>>Geography</option>
<option value="268" <?php if(@$FirstDiscipline == "268"){ echo "selected='selected'";} ?>>Geohydrology</option>
<option value="269" <?php if(@$FirstDiscipline == "269"){ echo "selected='selected'";} ?>>Geology</option>
<option value="270" <?php if(@$FirstDiscipline == "270"){ echo "selected='selected'";} ?>>Geometric Analysis</option>
<option value="271" <?php if(@$FirstDiscipline == "271"){ echo "selected='selected'";} ?>>Geomorphology</option>
<option value="272" <?php if(@$FirstDiscipline == "272"){ echo "selected='selected'";} ?>>Geophysics</option>
<option value="273" <?php if(@$FirstDiscipline == "273"){ echo "selected='selected'";} ?>>Geosciences (other)</option>
<option value="274" <?php if(@$FirstDiscipline == "274"){ echo "selected='selected'";} ?>>Geospace Physics</option>
<option value="275" <?php if(@$FirstDiscipline == "275"){ echo "selected='selected'";} ?>>Geriatrics</option>
<option value="276" <?php if(@$FirstDiscipline == "276"){ echo "selected='selected'";} ?>>Glaciology</option>
<option value="277" <?php if(@$FirstDiscipline == "277"){ echo "selected='selected'";} ?>>Global Change, Society and Sustainability</option>
<option value="278" <?php if(@$FirstDiscipline == "278"){ echo "selected='selected'";} ?>>GMS (other)</option>
<option value="279" <?php if(@$FirstDiscipline == "279"){ echo "selected='selected'";} ?>>Graphics and Visualization</option>
<option value="280" <?php if(@$FirstDiscipline == "280"){ echo "selected='selected'";} ?>>Gynaecology</option>
<option value="281" <?php if(@$FirstDiscipline == "281"){ echo "selected='selected'";} ?>>Haematology</option>
<option value="282" <?php if(@$FirstDiscipline == "282"){ echo "selected='selected'";} ?>>Health</option>
<option value="283" <?php if(@$FirstDiscipline == "283"){ echo "selected='selected'";} ?>>Health Economics</option>
<option value="284" <?php if(@$FirstDiscipline == "284"){ echo "selected='selected'";} ?>>Health Informatics</option>
<option value="285" <?php if(@$FirstDiscipline == "285"){ echo "selected='selected'";} ?>>Health Promotion</option>
<option value="286" <?php if(@$FirstDiscipline == "286"){ echo "selected='selected'";} ?>>Health Promotion </option>
<option value="287" <?php if(@$FirstDiscipline == "287"){ echo "selected='selected'";} ?>>Health promotion &  Diesease Prevention</option>
<option value="288" <?php if(@$FirstDiscipline == "288"){ echo "selected='selected'";} ?>>Health Promotion & Diease Prevention</option>
<option value="289" <?php if(@$FirstDiscipline == "289"){ echo "selected='selected'";} ?>>Health Promotion & Disease Prevention</option>
<option value="290" <?php if(@$FirstDiscipline == "290"){ echo "selected='selected'";} ?>>Health Sciences</option>
<option value="291" <?php if(@$FirstDiscipline == "291"){ echo "selected='selected'";} ?>>Health Systems & Research</option>
<option value="292" <?php if(@$FirstDiscipline == "292"){ echo "selected='selected'";} ?>>Health Systems Research</option>
<option value="293" <?php if(@$FirstDiscipline == "293"){ echo "selected='selected'";} ?>>Health Technology</option>
<option value="294" <?php if(@$FirstDiscipline == "294"){ echo "selected='selected'";} ?>>Heath Economics</option>
<option value="295" <?php if(@$FirstDiscipline == "295"){ echo "selected='selected'";} ?>>Historical studies</option>
<option value="296" <?php if(@$FirstDiscipline == "296"){ echo "selected='selected'";} ?>>History of arts</option>
<option value="297" <?php if(@$FirstDiscipline == "297"){ echo "selected='selected'";} ?>>HMS (other)</option>
<option value="298" <?php if(@$FirstDiscipline == "298"){ echo "selected='selected'";} ?>>Home economics</option>
<option value="299" <?php if(@$FirstDiscipline == "299"){ echo "selected='selected'";} ?>>Horticulture</option>
<option value="300" <?php if(@$FirstDiscipline == "300"){ echo "selected='selected'";} ?>>Horticulture </option>
<option value="301" <?php if(@$FirstDiscipline == "301"){ echo "selected='selected'";} ?>>Human anatomy and physiology</option>
<option value="302" <?php if(@$FirstDiscipline == "302"){ echo "selected='selected'";} ?>>Human Computer Interaction</option>
<option value="303" <?php if(@$FirstDiscipline == "303"){ echo "selected='selected'";} ?>>Human geography</option>
<option value="304" <?php if(@$FirstDiscipline == "304"){ echo "selected='selected'";} ?>>Human Movement science</option>
<option value="305" <?php if(@$FirstDiscipline == "305"){ echo "selected='selected'";} ?>>Human Movement Sciences</option>
<option value="306" <?php if(@$FirstDiscipline == "306"){ echo "selected='selected'";} ?>>Human Physiology</option>
<option value="307" <?php if(@$FirstDiscipline == "307"){ echo "selected='selected'";} ?>>Human Resources</option>
<option value="308" <?php if(@$FirstDiscipline == "308"){ echo "selected='selected'";} ?>>Human Systems Research</option>
<option value="309" <?php if(@$FirstDiscipline == "309"){ echo "selected='selected'";} ?>>Humanities</option>
<option value="310" <?php if(@$FirstDiscipline == "310"){ echo "selected='selected'";} ?>>Humanities and Arts</option>
<option value="311" <?php if(@$FirstDiscipline == "311"){ echo "selected='selected'";} ?>>Hydrology</option>
<option value="312" <?php if(@$FirstDiscipline == "312"){ echo "selected='selected'";} ?>>ICT</option>
<option value="313" <?php if(@$FirstDiscipline == "313"){ echo "selected='selected'";} ?>>Immunology</option>
<option value="314" <?php if(@$FirstDiscipline == "314"){ echo "selected='selected'";} ?>>Immunology, Virology and Infectious diseases</option>
<option value="315" <?php if(@$FirstDiscipline == "315"){ echo "selected='selected'";} ?>>Indigenous Knowledge Systems</option>
<option value="316" <?php if(@$FirstDiscipline == "316"){ echo "selected='selected'";} ?>>Industrial Biotechnology</option>
<option value="317" <?php if(@$FirstDiscipline == "317"){ echo "selected='selected'";} ?>>Industrial design</option>
<option value="318" <?php if(@$FirstDiscipline == "318"){ echo "selected='selected'";} ?>>Industrial Engineering</option>
<option value="319" <?php if(@$FirstDiscipline == "319"){ echo "selected='selected'";} ?>>Industrial Engineering & Operations Research</option>
<option value="320" <?php if(@$FirstDiscipline == "320"){ echo "selected='selected'";} ?>>Industrial Psychology</option>
<option value="321" <?php if(@$FirstDiscipline == "321"){ echo "selected='selected'";} ?>>Industrial Psychology & Sociology</option>
<option value="322" <?php if(@$FirstDiscipline == "322"){ echo "selected='selected'";} ?>>Infectious Diseases</option>
<option value="323" <?php if(@$FirstDiscipline == "323"){ echo "selected='selected'";} ?>>Infomation Systems & Technologies</option>
<option value="324" <?php if(@$FirstDiscipline == "324"){ echo "selected='selected'";} ?>>Information  & Computer Technologies</option>
<option value="325" <?php if(@$FirstDiscipline == "325"){ echo "selected='selected'";} ?>>Information & Computer Science</option>
<option value="326" <?php if(@$FirstDiscipline == "326"){ echo "selected='selected'";} ?>>Information & Computer Sciences</option>
<option value="327" <?php if(@$FirstDiscipline == "327"){ echo "selected='selected'";} ?>>Information & Computer Technologies</option>
<option value="328" <?php if(@$FirstDiscipline == "328"){ echo "selected='selected'";} ?>>Information & Computer Technology</option>
<option value="329" <?php if(@$FirstDiscipline == "329"){ echo "selected='selected'";} ?>>Information & Library Science</option>
<option value="330" <?php if(@$FirstDiscipline == "330"){ echo "selected='selected'";} ?>>Information & Library Sciences</option>
<option value="331" <?php if(@$FirstDiscipline == "331"){ echo "selected='selected'";} ?>>Information and Communication Technology (ICT)</option>
<option value="332" <?php if(@$FirstDiscipline == "332"){ echo "selected='selected'";} ?>>Information and Computer science</option>
<option value="333" <?php if(@$FirstDiscipline == "333"){ echo "selected='selected'";} ?>>Information Communication Technology</option>
<option value="334" <?php if(@$FirstDiscipline == "334"){ echo "selected='selected'";} ?>>Information Engineering</option>
<option value="335" <?php if(@$FirstDiscipline == "335"){ echo "selected='selected'";} ?>>Information Management</option>
<option value="336" <?php if(@$FirstDiscipline == "336"){ echo "selected='selected'";} ?>>Information Mangagement</option>
<option value="337" <?php if(@$FirstDiscipline == "337"){ echo "selected='selected'";} ?>>Information Science</option>
<option value="338" <?php if(@$FirstDiscipline == "338"){ echo "selected='selected'";} ?>>Information Systems</option>
<option value="339" <?php if(@$FirstDiscipline == "339"){ echo "selected='selected'";} ?>>Information Systems & Technologies</option>
<option value="340" <?php if(@$FirstDiscipline == "340"){ echo "selected='selected'";} ?>>Information Systems & Technology</option>
<option value="341" <?php if(@$FirstDiscipline == "341"){ echo "selected='selected'";} ?>>Information Technology</option>
<option value="342" <?php if(@$FirstDiscipline == "342"){ echo "selected='selected'";} ?>>Information, Communication, Control Systems</option>
<option value="343" <?php if(@$FirstDiscipline == "343"){ echo "selected='selected'";} ?>>Informations Systems</option>
<option value="344" <?php if(@$FirstDiscipline == "344"){ echo "selected='selected'";} ?>>Innovation & Technology Transfer</option>
<option value="345" <?php if(@$FirstDiscipline == "345"){ echo "selected='selected'";} ?>>Inorganic Chemistry</option>
<option value="346" <?php if(@$FirstDiscipline == "346"){ echo "selected='selected'";} ?>>Intensive care</option>
<option value="347" <?php if(@$FirstDiscipline == "347"){ echo "selected='selected'";} ?>>International law</option>
<option value="348" <?php if(@$FirstDiscipline == "348"){ echo "selected='selected'";} ?>>International Relations</option>
<option value="349" <?php if(@$FirstDiscipline == "349"){ echo "selected='selected'";} ?>>Invertebrate Taxonomy</option>
<option value="350" <?php if(@$FirstDiscipline == "350"){ echo "selected='selected'";} ?>>IT Graphic Design</option>
<option value="351" <?php if(@$FirstDiscipline == "351"){ echo "selected='selected'";} ?>>IT-Graphic Design</option>
<option value="352" <?php if(@$FirstDiscipline == "352"){ echo "selected='selected'";} ?>>Jurisprudence</option>
<option value="353" <?php if(@$FirstDiscipline == "353"){ echo "selected='selected'";} ?>>Knowledge Management (Records Administration)</option>
<option value="354" <?php if(@$FirstDiscipline == "354"){ echo "selected='selected'";} ?>>Labour, social service, education and cultural law</option>
<option value="355" <?php if(@$FirstDiscipline == "355"){ echo "selected='selected'";} ?>>Languages</option>
<option value="356" <?php if(@$FirstDiscipline == "356"){ echo "selected='selected'";} ?>>Languages & Literature</option>
<option value="357" <?php if(@$FirstDiscipline == "357"){ echo "selected='selected'";} ?>>Languages and literature</option>
<option value="358" <?php if(@$FirstDiscipline == "358"){ echo "selected='selected'";} ?>>Law</option>
<option value="359" <?php if(@$FirstDiscipline == "359"){ echo "selected='selected'";} ?>>Laws (Statutes), regulations, cases</option>
<option value="360" <?php if(@$FirstDiscipline == "360"){ echo "selected='selected'";} ?>>Leadership</option>
<option value="361" <?php if(@$FirstDiscipline == "361"){ echo "selected='selected'";} ?>>Legal history</option>
<option value="362" <?php if(@$FirstDiscipline == "362"){ echo "selected='selected'";} ?>>Librarianship</option>
<option value="363" <?php if(@$FirstDiscipline == "363"){ echo "selected='selected'";} ?>>Library and Information Sciences</option>
<option value="364" <?php if(@$FirstDiscipline == "364"){ echo "selected='selected'";} ?>>Library Science</option>
<option value="365" <?php if(@$FirstDiscipline == "365"){ echo "selected='selected'";} ?>>Library Sciences</option>
<option value="366" <?php if(@$FirstDiscipline == "366"){ echo "selected='selected'";} ?>>Library Services</option>
<option value="367" <?php if(@$FirstDiscipline == "367"){ echo "selected='selected'";} ?>>Limnology</option>
<option value="368" <?php if(@$FirstDiscipline == "368"){ echo "selected='selected'";} ?>>Linguistics</option>
<option value="369" <?php if(@$FirstDiscipline == "369"){ echo "selected='selected'";} ?>>Literature</option>
<option value="370" <?php if(@$FirstDiscipline == "370"){ echo "selected='selected'";} ?>>Logic or Foundations of Mathematics</option>
<option value="371" <?php if(@$FirstDiscipline == "371"){ echo "selected='selected'";} ?>>Machine Learning</option>
<option value="372" <?php if(@$FirstDiscipline == "372"){ echo "selected='selected'";} ?>>Macro-Invertebrates</option>
<option value="373" <?php if(@$FirstDiscipline == "373"){ echo "selected='selected'";} ?>>Macromolecular, Supramolecular, and Nanochemistry</option>
<option value="374" <?php if(@$FirstDiscipline == "374"){ echo "selected='selected'";} ?>>Magnetospheric Physics</option>
<option value="375" <?php if(@$FirstDiscipline == "375"){ echo "selected='selected'";} ?>>Management</option>
<option value="376" <?php if(@$FirstDiscipline == "376"){ echo "selected='selected'";} ?>>Management Sciences</option>
<option value="377" <?php if(@$FirstDiscipline == "377"){ echo "selected='selected'";} ?>>Management Studies</option>
<option value="378" <?php if(@$FirstDiscipline == "378"){ echo "selected='selected'";} ?>>Manufacturing & Process Techniques</option>
<option value="379" <?php if(@$FirstDiscipline == "379"){ echo "selected='selected'";} ?>>Manufacturing & Process Technologies</option>
<option value="380" <?php if(@$FirstDiscipline == "380"){ echo "selected='selected'";} ?>>Marine Biology</option>
<option value="381" <?php if(@$FirstDiscipline == "381"){ echo "selected='selected'";} ?>>Marine Engineering & Naval Architecture</option>
<option value="382" <?php if(@$FirstDiscipline == "382"){ echo "selected='selected'";} ?>>Marine engineering and navel architecture</option>
<option value="383" <?php if(@$FirstDiscipline == "383"){ echo "selected='selected'";} ?>>Marine Geology and Geophysics</option>
<option value="384" <?php if(@$FirstDiscipline == "384"){ echo "selected='selected'";} ?>>Marine Sciences</option>
<option value="385" <?php if(@$FirstDiscipline == "385"){ echo "selected='selected'";} ?>>Marketing</option>
<option value="386" <?php if(@$FirstDiscipline == "386"){ echo "selected='selected'";} ?>>Material Science & Technologies</option>
<option value="387" <?php if(@$FirstDiscipline == "387"){ echo "selected='selected'";} ?>>Material Sciences & Technologies</option>
<option value="388" <?php if(@$FirstDiscipline == "388"){ echo "selected='selected'";} ?>>Materials and Manufacturing</option>
<option value="389" <?php if(@$FirstDiscipline == "389"){ echo "selected='selected'";} ?>>Materials engineering</option>
<option value="390" <?php if(@$FirstDiscipline == "390"){ echo "selected='selected'";} ?>>Materials theory and Research</option>
<option value="391" <?php if(@$FirstDiscipline == "391"){ echo "selected='selected'";} ?>>Mathematical Biology</option>
<option value="392" <?php if(@$FirstDiscipline == "392"){ echo "selected='selected'";} ?>>Mathematical Science</option>
<option value="393" <?php if(@$FirstDiscipline == "393"){ echo "selected='selected'";} ?>>Mathematical Sciences</option>
<option value="394" <?php if(@$FirstDiscipline == "394"){ echo "selected='selected'";} ?>>Mathematics</option>
<option value="395" <?php if(@$FirstDiscipline == "395"){ echo "selected='selected'";} ?>>Mathematics (other)</option>
<option value="396" <?php if(@$FirstDiscipline == "396"){ echo "selected='selected'";} ?>>Mathematics Education</option>
<option value="397" <?php if(@$FirstDiscipline == "397"){ echo "selected='selected'";} ?>>Mechanical Engineering</option>
<option value="398" <?php if(@$FirstDiscipline == "398"){ echo "selected='selected'";} ?>>Mechanics</option>
<option value="399" <?php if(@$FirstDiscipline == "399"){ echo "selected='selected'";} ?>>Mechnical Engineering</option>
<option value="400" <?php if(@$FirstDiscipline == "400"){ echo "selected='selected'";} ?>>Media & Communications</option>
<option value="401" <?php if(@$FirstDiscipline == "401"){ echo "selected='selected'";} ?>>Media Studies</option>
<option value="402" <?php if(@$FirstDiscipline == "402"){ echo "selected='selected'";} ?>>Medical Biotechnology</option>
<option value="403" <?php if(@$FirstDiscipline == "403"){ echo "selected='selected'";} ?>>Medical engineering</option>
<option value="404" <?php if(@$FirstDiscipline == "404"){ echo "selected='selected'";} ?>>Medical Microbiology</option>
<option value="405" <?php if(@$FirstDiscipline == "405"){ echo "selected='selected'";} ?>>Medical Microbiology </option>
<option value="406" <?php if(@$FirstDiscipline == "406"){ echo "selected='selected'";} ?>>Medical Sciences</option>
<option value="407" <?php if(@$FirstDiscipline == "407"){ echo "selected='selected'";} ?>>Medical sciences: Basic</option>
<option value="408" <?php if(@$FirstDiscipline == "408"){ echo "selected='selected'";} ?>>Medical sciences: Clinical</option>
<option value="409" <?php if(@$FirstDiscipline == "409"){ echo "selected='selected'";} ?>>Medical Technologies</option>
<option value="410" <?php if(@$FirstDiscipline == "410"){ echo "selected='selected'";} ?>>Medical Virology</option>
<option value="411" <?php if(@$FirstDiscipline == "411"){ echo "selected='selected'";} ?>>Medicinal Plant Research</option>
<option value="412" <?php if(@$FirstDiscipline == "412"){ echo "selected='selected'";} ?>>Mental Health & Substance Abuse</option>
<option value="413" <?php if(@$FirstDiscipline == "413"){ echo "selected='selected'";} ?>>Mental health and substance abuse</option>
<option value="414" <?php if(@$FirstDiscipline == "414"){ echo "selected='selected'";} ?>>Metabolic diseases</option>
<option value="415" <?php if(@$FirstDiscipline == "415"){ echo "selected='selected'";} ?>>Metallic materials</option>
<option value="416" <?php if(@$FirstDiscipline == "416"){ echo "selected='selected'";} ?>>Metallurgical Engineering</option>
<option value="417" <?php if(@$FirstDiscipline == "417"){ echo "selected='selected'";} ?>>Microbiology</option>
<option value="418" <?php if(@$FirstDiscipline == "418"){ echo "selected='selected'";} ?>>Military and defence law</option>
<option value="419" <?php if(@$FirstDiscipline == "419"){ echo "selected='selected'";} ?>>Mining and Mineral Processing</option>
<option value="420" <?php if(@$FirstDiscipline == "420"){ echo "selected='selected'";} ?>>Mining engineering</option>
<option value="421" <?php if(@$FirstDiscipline == "421"){ echo "selected='selected'";} ?>>Molecular & Cell Biology</option>
<option value="422" <?php if(@$FirstDiscipline == "422"){ echo "selected='selected'";} ?>>Molecular and Cell Biology</option>
<option value="423" <?php if(@$FirstDiscipline == "423"){ echo "selected='selected'";} ?>>Molecular cell biology</option>
<option value="424" <?php if(@$FirstDiscipline == "424"){ echo "selected='selected'";} ?>>Molecular modelling</option>
<option value="425" <?php if(@$FirstDiscipline == "425"){ echo "selected='selected'";} ?>>Morphology</option>
<option value="426" <?php if(@$FirstDiscipline == "426"){ echo "selected='selected'";} ?>>Music</option>
<option value="427" <?php if(@$FirstDiscipline == "427"){ echo "selected='selected'";} ?>>Musicology</option>
<option value="428" <?php if(@$FirstDiscipline == "428"){ echo "selected='selected'";} ?>>Nanotechnology</option>
<option value="429" <?php if(@$FirstDiscipline == "429"){ echo "selected='selected'";} ?>>Natural Language Processing</option>
<option value="430" <?php if(@$FirstDiscipline == "430"){ echo "selected='selected'";} ?>>Natural Science</option>
<option value="431" <?php if(@$FirstDiscipline == "431"){ echo "selected='selected'";} ?>>Natural Sciences</option>
<option value="432" <?php if(@$FirstDiscipline == "432"){ echo "selected='selected'";} ?>>Neurology</option>
<option value="433" <?php if(@$FirstDiscipline == "433"){ echo "selected='selected'";} ?>>Neurology and Psychiatry</option>
<option value="434" <?php if(@$FirstDiscipline == "434"){ echo "selected='selected'";} ?>>Neuroscience</option>
<option value="435" <?php if(@$FirstDiscipline == "435"){ echo "selected='selected'";} ?>>Neurosciences</option>
<option value="436" <?php if(@$FirstDiscipline == "436"){ echo "selected='selected'";} ?>>NLS (other)</option>
<option value="437" <?php if(@$FirstDiscipline == "437"){ echo "selected='selected'";} ?>>Nuclear Engineering</option>
<option value="438" <?php if(@$FirstDiscipline == "438"){ echo "selected='selected'";} ?>>Nuclear Medicine & Organ Imaging</option>
<option value="439" <?php if(@$FirstDiscipline == "439"){ echo "selected='selected'";} ?>>Nuclear physics</option>
<option value="440" <?php if(@$FirstDiscipline == "440"){ echo "selected='selected'";} ?>>Nuclear Technologies in Medicine and Biosciences</option>
<option value="441" <?php if(@$FirstDiscipline == "441"){ echo "selected='selected'";} ?>>Nursing Science</option>
<option value="442" <?php if(@$FirstDiscipline == "442"){ echo "selected='selected'";} ?>>Nutrition</option>
<option value="443" <?php if(@$FirstDiscipline == "443"){ echo "selected='selected'";} ?>>Nutrition </option>
<option value="444" <?php if(@$FirstDiscipline == "444"){ echo "selected='selected'";} ?>>Nutrition & Metabolism</option>
<option value="445" <?php if(@$FirstDiscipline == "445"){ echo "selected='selected'";} ?>>Nutrition and Pediatrics</option>
<option value="446" <?php if(@$FirstDiscipline == "446"){ echo "selected='selected'";} ?>>Obstetrics & Maternal Health</option>
<option value="447" <?php if(@$FirstDiscipline == "447"){ echo "selected='selected'";} ?>>Obstetrics and maternal health</option>
<option value="448" <?php if(@$FirstDiscipline == "448"){ echo "selected='selected'";} ?>>Occupational health</option>
<option value="449" <?php if(@$FirstDiscipline == "449"){ echo "selected='selected'";} ?>>Oceanography</option>
<option value="450" <?php if(@$FirstDiscipline == "450"){ echo "selected='selected'";} ?>>Oceanology</option>
<option value="451" <?php if(@$FirstDiscipline == "451"){ echo "selected='selected'";} ?>>Oncology</option>
<option value="452" <?php if(@$FirstDiscipline == "452"){ echo "selected='selected'";} ?>>Operations research</option>
<option value="453" <?php if(@$FirstDiscipline == "453"){ echo "selected='selected'";} ?>>Ophthalmology</option>
<option value="454" <?php if(@$FirstDiscipline == "454"){ echo "selected='selected'";} ?>>Optical Engineering</option>
<option value="455" <?php if(@$FirstDiscipline == "455"){ echo "selected='selected'";} ?>>Optics</option>
<option value="456" <?php if(@$FirstDiscipline == "456"){ echo "selected='selected'";} ?>>Organic Chemistry</option>
<option value="457" <?php if(@$FirstDiscipline == "457"){ echo "selected='selected'";} ?>>Organic Sciences</option>
<option value="458" <?php if(@$FirstDiscipline == "458"){ echo "selected='selected'";} ?>>Organismal Biology</option>
<option value="459" <?php if(@$FirstDiscipline == "459"){ echo "selected='selected'";} ?>>Orthopaedics</option>
<option value="460" <?php if(@$FirstDiscipline == "460"){ echo "selected='selected'";} ?>>Other</option>
<option value="461" <?php if(@$FirstDiscipline == "461"){ echo "selected='selected'";} ?>>Other information and computer technologies</option>
<option value="462" <?php if(@$FirstDiscipline == "462"){ echo "selected='selected'";} ?>>Otorhinolaryngology</option>
<option value="463" <?php if(@$FirstDiscipline == "463"){ echo "selected='selected'";} ?>>Paediatrics & Child Health</option>
<option value="464" <?php if(@$FirstDiscipline == "464"){ echo "selected='selected'";} ?>>Paediatrics and child health</option>
<option value="465" <?php if(@$FirstDiscipline == "465"){ echo "selected='selected'";} ?>>Painting</option>
<option value="466" <?php if(@$FirstDiscipline == "466"){ echo "selected='selected'";} ?>>Palaeontology</option>
<option value="467" <?php if(@$FirstDiscipline == "467"){ echo "selected='selected'";} ?>>Palaeosciences</option>
<option value="468" <?php if(@$FirstDiscipline == "468"){ echo "selected='selected'";} ?>>Paleoclimate</option>
<option value="469" <?php if(@$FirstDiscipline == "469"){ echo "selected='selected'";} ?>>Paleontology</option>
<option value="470" <?php if(@$FirstDiscipline == "470"){ echo "selected='selected'";} ?>>Paleontology and Paleobiology</option>
<option value="471" <?php if(@$FirstDiscipline == "471"){ echo "selected='selected'";} ?>>Parasitology</option>
<option value="472" <?php if(@$FirstDiscipline == "472"){ echo "selected='selected'";} ?>>Particle</option>
<option value="473" <?php if(@$FirstDiscipline == "473"){ echo "selected='selected'";} ?>>Particle & Plasma Physics</option>
<option value="474" <?php if(@$FirstDiscipline == "474"){ echo "selected='selected'";} ?>>Particle and plasma physics</option>
<option value="475" <?php if(@$FirstDiscipline == "475"){ echo "selected='selected'";} ?>>Patient-oriented research</option>
<option value="476" <?php if(@$FirstDiscipline == "476"){ echo "selected='selected'";} ?>>Pediatrics & Child Health</option>
<option value="477" <?php if(@$FirstDiscipline == "477"){ echo "selected='selected'";} ?>>Performing and Creative Arts</option>
<option value="478" <?php if(@$FirstDiscipline == "478"){ echo "selected='selected'";} ?>>Performing arts</option>
<option value="479" <?php if(@$FirstDiscipline == "479"){ echo "selected='selected'";} ?>>Petrology</option>
<option value="480" <?php if(@$FirstDiscipline == "480"){ echo "selected='selected'";} ?>>Pharmaceutical Science</option>
<option value="481" <?php if(@$FirstDiscipline == "481"){ echo "selected='selected'";} ?>>Pharmaceutical Sciences</option>
<option value="482" <?php if(@$FirstDiscipline == "482"){ echo "selected='selected'";} ?>>Pharmacology</option>
<option value="483" <?php if(@$FirstDiscipline == "483"){ echo "selected='selected'";} ?>>Pharmacology </option>
<option value="484" <?php if(@$FirstDiscipline == "484"){ echo "selected='selected'";} ?>>Pharmacology & Pharmaceutical Sciences</option>
<option value="485" <?php if(@$FirstDiscipline == "485"){ echo "selected='selected'";} ?>>Phenomenological Physics</option>
<option value="486" <?php if(@$FirstDiscipline == "486"){ echo "selected='selected'";} ?>>Philosophy</option>
<option value="487" <?php if(@$FirstDiscipline == "487"){ echo "selected='selected'";} ?>>Photography</option>
<option value="488" <?php if(@$FirstDiscipline == "488"){ echo "selected='selected'";} ?>>Photonic materials</option>
<option value="489" <?php if(@$FirstDiscipline == "489"){ echo "selected='selected'";} ?>>Physcial Geopraphy </option>
<option value="490" <?php if(@$FirstDiscipline == "490"){ echo "selected='selected'";} ?>>Physical and Dynamic Meteorology</option>
<option value="491" <?php if(@$FirstDiscipline == "491"){ echo "selected='selected'";} ?>>Physical Chemistry</option>
<option value="492" <?php if(@$FirstDiscipline == "492"){ echo "selected='selected'";} ?>>Physical Geography</option>
<option value="493" <?php if(@$FirstDiscipline == "493"){ echo "selected='selected'";} ?>>Physical Oceanography</option>
<option value="494" <?php if(@$FirstDiscipline == "494"){ echo "selected='selected'";} ?>>Physical Sciences</option>
<option value="495" <?php if(@$FirstDiscipline == "495"){ echo "selected='selected'";} ?>>Physics</option>
<option value="496" <?php if(@$FirstDiscipline == "496"){ echo "selected='selected'";} ?>>Physics </option>
<option value="497" <?php if(@$FirstDiscipline == "497"){ echo "selected='selected'";} ?>>Physics (other)</option>
<option value="498" <?php if(@$FirstDiscipline == "498"){ echo "selected='selected'";} ?>>Physics of Living Systems</option>
<option value="499" <?php if(@$FirstDiscipline == "499"){ echo "selected='selected'";} ?>>Physiology</option>
<option value="500" <?php if(@$FirstDiscipline == "500"){ echo "selected='selected'";} ?>>Physiology Polymer Sciences</option>
<option value="501" <?php if(@$FirstDiscipline == "501"){ echo "selected='selected'";} ?>>Phyto-chemistry</option>
<option value="502" <?php if(@$FirstDiscipline == "502"){ echo "selected='selected'";} ?>>Plant Biotechnology</option>
<option value="503" <?php if(@$FirstDiscipline == "503"){ echo "selected='selected'";} ?>>Plant Pathology</option>
<option value="504" <?php if(@$FirstDiscipline == "504"){ echo "selected='selected'";} ?>>Plant Production</option>
<option value="505" <?php if(@$FirstDiscipline == "505"){ echo "selected='selected'";} ?>>Plant Sciences</option>
<option value="506" <?php if(@$FirstDiscipline == "506"){ echo "selected='selected'";} ?>>Plasma</option>
<option value="507" <?php if(@$FirstDiscipline == "507"){ echo "selected='selected'";} ?>>Podiatry</option>
<option value="508" <?php if(@$FirstDiscipline == "508"){ echo "selected='selected'";} ?>>Polar Science</option>
<option value="509" <?php if(@$FirstDiscipline == "509"){ echo "selected='selected'";} ?>>Policy Studies</option>
<option value="510" <?php if(@$FirstDiscipline == "510"){ echo "selected='selected'";} ?>>Political Sciences</option>
<option value="511" <?php if(@$FirstDiscipline == "511"){ echo "selected='selected'";} ?>>Political Sciences </option>
<option value="512" <?php if(@$FirstDiscipline == "512"){ echo "selected='selected'";} ?>>Political Sciences & Public Policy</option>
<option value="513" <?php if(@$FirstDiscipline == "513"){ echo "selected='selected'";} ?>>Political Studies</option>
<option value="514" <?php if(@$FirstDiscipline == "514"){ echo "selected='selected'";} ?>>Polymer Science</option>
<option value="515" <?php if(@$FirstDiscipline == "515"){ echo "selected='selected'";} ?>>Polymer Sciences</option>
<option value="516" <?php if(@$FirstDiscipline == "516"){ echo "selected='selected'";} ?>>Polymers</option>
<option value="517" <?php if(@$FirstDiscipline == "517"){ echo "selected='selected'";} ?>>Power Systems Development</option>
<option value="518" <?php if(@$FirstDiscipline == "518"){ echo "selected='selected'";} ?>>Private law</option>
<option value="519" <?php if(@$FirstDiscipline == "519"){ echo "selected='selected'";} ?>>Probability</option>
<option value="520" <?php if(@$FirstDiscipline == "520"){ echo "selected='selected'";} ?>>Process Engineering</option>
<option value="521" <?php if(@$FirstDiscipline == "521"){ echo "selected='selected'";} ?>>Process Manufacturing</option>
<option value="522" <?php if(@$FirstDiscipline == "522"){ echo "selected='selected'";} ?>>Proteomics</option>
<option value="523" <?php if(@$FirstDiscipline == "523"){ echo "selected='selected'";} ?>>Psychiatry</option>
<option value="524" <?php if(@$FirstDiscipline == "524"){ echo "selected='selected'";} ?>>Psychology</option>
<option value="525" <?php if(@$FirstDiscipline == "525"){ echo "selected='selected'";} ?>>Public Administration</option>
<option value="526" <?php if(@$FirstDiscipline == "526"){ echo "selected='selected'";} ?>>Public and Science Policy   </option>
<option value="527" <?php if(@$FirstDiscipline == "527"){ echo "selected='selected'";} ?>>Public Health</option>
<option value="528" <?php if(@$FirstDiscipline == "528"){ echo "selected='selected'";} ?>>Public law</option>
<option value="529" <?php if(@$FirstDiscipline == "529"){ echo "selected='selected'";} ?>>Public Management & Administration</option>
<option value="530" <?php if(@$FirstDiscipline == "530"){ echo "selected='selected'";} ?>>Public management and administration</option>
<option value="531" <?php if(@$FirstDiscipline == "531"){ echo "selected='selected'";} ?>>Public Relations</option>
<option value="532" <?php if(@$FirstDiscipline == "532"){ echo "selected='selected'";} ?>>Quality Management</option>
<option value="533" <?php if(@$FirstDiscipline == "533"){ echo "selected='selected'";} ?>>Quantity surveying</option>
<option value="534" <?php if(@$FirstDiscipline == "534"){ echo "selected='selected'";} ?>>R & D Psychology</option>
<option value="535" <?php if(@$FirstDiscipline == "535"){ echo "selected='selected'";} ?>>R & D Sociology</option>
<option value="536" <?php if(@$FirstDiscipline == "536"){ echo "selected='selected'";} ?>>R&D Psychology</option>
<option value="537" <?php if(@$FirstDiscipline == "537"){ echo "selected='selected'";} ?>>Rehabilitation Medicine</option>
<option value="538" <?php if(@$FirstDiscipline == "538"){ echo "selected='selected'";} ?>>Religion</option>
<option value="539" <?php if(@$FirstDiscipline == "539"){ echo "selected='selected'";} ?>>Religious legal systems</option>
<option value="540" <?php if(@$FirstDiscipline == "540"){ echo "selected='selected'";} ?>>Religious studies</option>
<option value="541" <?php if(@$FirstDiscipline == "541"){ echo "selected='selected'";} ?>>Remote Sensing</option>
<option value="542" <?php if(@$FirstDiscipline == "542"){ echo "selected='selected'";} ?>>Renewable Energy</option>
<option value="543" <?php if(@$FirstDiscipline == "543"){ echo "selected='selected'";} ?>>Research Management</option>
<option value="544" <?php if(@$FirstDiscipline == "544"){ echo "selected='selected'";} ?>>Research Management with Mathematics</option>
<option value="545" <?php if(@$FirstDiscipline == "545"){ echo "selected='selected'";} ?>>Research Management, Research Support & Administration</option>
<option value="546" <?php if(@$FirstDiscipline == "546"){ echo "selected='selected'";} ?>>Respiratory diseases</option>
<option value="547" <?php if(@$FirstDiscipline == "547"){ echo "selected='selected'";} ?>>Rheumatology</option>
<option value="548" <?php if(@$FirstDiscipline == "548"){ echo "selected='selected'";} ?>>Robotics and Computer Vision</option>
<option value="549" <?php if(@$FirstDiscipline == "549"){ echo "selected='selected'";} ?>>Rural Development</option>
<option value="550" <?php if(@$FirstDiscipline == "550"){ echo "selected='selected'";} ?>>Science & Statistics</option>
<option value="551" <?php if(@$FirstDiscipline == "551"){ echo "selected='selected'";} ?>>Science & Technologies</option>
<option value="552" <?php if(@$FirstDiscipline == "552"){ echo "selected='selected'";} ?>>Science & Technology</option>
<option value="553" <?php if(@$FirstDiscipline == "553"){ echo "selected='selected'";} ?>>Science and state</option>
<option value="554" <?php if(@$FirstDiscipline == "554"){ echo "selected='selected'";} ?>>Science Education</option>
<option value="555" <?php if(@$FirstDiscipline == "555"){ echo "selected='selected'";} ?>>Science Education </option>
<option value="556" <?php if(@$FirstDiscipline == "556"){ echo "selected='selected'";} ?>>Science Journalism</option>
<option value="557" <?php if(@$FirstDiscipline == "557"){ echo "selected='selected'";} ?>>Sculpture</option>
<option value="558" <?php if(@$FirstDiscipline == "558"){ echo "selected='selected'";} ?>>Sedimentary Geology</option>
<option value="559" <?php if(@$FirstDiscipline == "559"){ echo "selected='selected'";} ?>>Social & Economic Geography</option>
<option value="560" <?php if(@$FirstDiscipline == "560"){ echo "selected='selected'";} ?>>Social Science</option>
<option value="561" <?php if(@$FirstDiscipline == "561"){ echo "selected='selected'";} ?>>Social Science and Humanities</option>
<option value="562" <?php if(@$FirstDiscipline == "562"){ echo "selected='selected'";} ?>>Social Sciences</option>
<option value="563" <?php if(@$FirstDiscipline == "563"){ echo "selected='selected'";} ?>>Social Sciences and Humanities</option>
<option value="564" <?php if(@$FirstDiscipline == "564"){ echo "selected='selected'";} ?>>Social work</option>
<option value="565" <?php if(@$FirstDiscipline == "565"){ echo "selected='selected'";} ?>>Social Work </option>
<option value="566" <?php if(@$FirstDiscipline == "566"){ echo "selected='selected'";} ?>>Sociology</option>
<option value="567" <?php if(@$FirstDiscipline == "567"){ echo "selected='selected'";} ?>>Software Engineering</option>
<option value="568" <?php if(@$FirstDiscipline == "568"){ echo "selected='selected'";} ?>>Soil & Water  Sciences</option>
<option value="569" <?php if(@$FirstDiscipline == "569"){ echo "selected='selected'";} ?>>Soil & Water Sciences</option>
<option value="570" <?php if(@$FirstDiscipline == "570"){ echo "selected='selected'";} ?>>Solar Physics</option>
<option value="571" <?php if(@$FirstDiscipline == "571"){ echo "selected='selected'";} ?>>Solid State</option>
<option value="572" <?php if(@$FirstDiscipline == "572"){ echo "selected='selected'";} ?>>Space & Earth Science</option>
<option value="573" <?php if(@$FirstDiscipline == "573"){ echo "selected='selected'";} ?>>Space and earth science</option>
<option value="574" <?php if(@$FirstDiscipline == "574"){ echo "selected='selected'";} ?>>Space Science</option>
<option value="575" <?php if(@$FirstDiscipline == "575"){ echo "selected='selected'";} ?>>Space Sciences</option>
<option value="576" <?php if(@$FirstDiscipline == "576"){ echo "selected='selected'";} ?>>Sport Sciences</option>
<option value="577" <?php if(@$FirstDiscipline == "577"){ echo "selected='selected'";} ?>>Sports & Recreational Arts</option>
<option value="578" <?php if(@$FirstDiscipline == "578"){ echo "selected='selected'";} ?>>Sports & Recreational Arts </option>
<option value="579" <?php if(@$FirstDiscipline == "579"){ echo "selected='selected'";} ?>>Sports Medicine</option>
<option value="580" <?php if(@$FirstDiscipline == "580"){ echo "selected='selected'";} ?>>Sports Sciences</option>
<option value="581" <?php if(@$FirstDiscipline == "581"){ echo "selected='selected'";} ?>>SSH (other)</option>
<option value="582" <?php if(@$FirstDiscipline == "582"){ echo "selected='selected'";} ?>>Statistics</option>
<option value="583" <?php if(@$FirstDiscipline == "583"){ echo "selected='selected'";} ?>>Statistics & Probability</option>
<option value="584" <?php if(@$FirstDiscipline == "584"){ echo "selected='selected'";} ?>>Stem cell and regenerative biology</option>
<option value="585" <?php if(@$FirstDiscipline == "585"){ echo "selected='selected'";} ?>>STEM Education and Learning Research (other)</option>
<option value="586" <?php if(@$FirstDiscipline == "586"){ echo "selected='selected'";} ?>>Strategy</option>
<option value="587" <?php if(@$FirstDiscipline == "587"){ echo "selected='selected'";} ?>>Structural Biology</option>
<option value="588" <?php if(@$FirstDiscipline == "588"){ echo "selected='selected'";} ?>>Surgery</option>
<option value="589" <?php if(@$FirstDiscipline == "589"){ echo "selected='selected'";} ?>>Sustainable Agriculture </option>
<option value="590" <?php if(@$FirstDiscipline == "590"){ echo "selected='selected'";} ?>>Sustainable Chemistry</option>
<option value="591" <?php if(@$FirstDiscipline == "591"){ echo "selected='selected'";} ?>>Sustainable Development</option>
<option value="592" <?php if(@$FirstDiscipline == "592"){ echo "selected='selected'";} ?>>Systematics and Biodiversity</option>
<option value="593" <?php if(@$FirstDiscipline == "593"){ echo "selected='selected'";} ?>>Systems and Molecular Biology</option>
<option value="594" <?php if(@$FirstDiscipline == "594"){ echo "selected='selected'";} ?>>Systems Engineering</option>
<option value="595" <?php if(@$FirstDiscipline == "595"){ echo "selected='selected'";} ?>>Tax law</option>
<option value="596" <?php if(@$FirstDiscipline == "596"){ echo "selected='selected'";} ?>>Taxonomy</option>
<option value="597" <?php if(@$FirstDiscipline == "597"){ echo "selected='selected'";} ?>>Technologies & Applied Sciences</option>
<option value="598" <?php if(@$FirstDiscipline == "598"){ echo "selected='selected'";} ?>>Technologies and applied sciences</option>
<option value="599" <?php if(@$FirstDiscipline == "599"){ echo "selected='selected'";} ?>>Technology Education</option>
<option value="600" <?php if(@$FirstDiscipline == "600"){ echo "selected='selected'";} ?>>Tectonics</option>
<option value="601" <?php if(@$FirstDiscipline == "601"){ echo "selected='selected'";} ?>>Theatre</option>
<option value="602" <?php if(@$FirstDiscipline == "602"){ echo "selected='selected'";} ?>>Theology</option>
<option value="603" <?php if(@$FirstDiscipline == "603"){ echo "selected='selected'";} ?>>Theology and Religion</option>
<option value="604" <?php if(@$FirstDiscipline == "604"){ echo "selected='selected'";} ?>>Theoretical & Condensed Matter Physics</option>
<option value="605" <?php if(@$FirstDiscipline == "605"){ echo "selected='selected'";} ?>>Theoretical Physics</option>
<option value="606" <?php if(@$FirstDiscipline == "606"){ echo "selected='selected'";} ?>>Topology</option>
<option value="607" <?php if(@$FirstDiscipline == "607"){ echo "selected='selected'";} ?>>Tourism</option>
<option value="608" <?php if(@$FirstDiscipline == "608"){ echo "selected='selected'";} ?>>Town & Regional Planning</option>
<option value="609" <?php if(@$FirstDiscipline == "609"){ echo "selected='selected'";} ?>>Toxicology</option>
<option value="610" <?php if(@$FirstDiscipline == "610"){ echo "selected='selected'";} ?>>Trade and commerce</option>
<option value="611" <?php if(@$FirstDiscipline == "611"){ echo "selected='selected'";} ?>>Transportation Studies</option>
<option value="612" <?php if(@$FirstDiscipline == "612"){ echo "selected='selected'";} ?>>Trauma</option>
<option value="613" <?php if(@$FirstDiscipline == "613"){ echo "selected='selected'";} ?>>Urban and Regional Planning</option>
<option value="614" <?php if(@$FirstDiscipline == "614"){ echo "selected='selected'";} ?>>Veterinary Microbiology</option>
<option value="615" <?php if(@$FirstDiscipline == "615"){ echo "selected='selected'";} ?>>Veterinary Nursing</option>
<option value="616" <?php if(@$FirstDiscipline == "616"){ echo "selected='selected'";} ?>>Veterinary Science</option>
<option value="617" <?php if(@$FirstDiscipline == "617"){ echo "selected='selected'";} ?>>Veterinary Sciences</option>
<option value="618" <?php if(@$FirstDiscipline == "618"){ echo "selected='selected'";} ?>>Virology</option>
<option value="622" <?php if(@$FirstDiscipline == "622"){ echo "selected='selected'";} ?>>Waste and Circular Economy</option>
<option value="619" <?php if(@$FirstDiscipline == "619"){ echo "selected='selected'";} ?>>Waves</option>
<option value="620" <?php if(@$FirstDiscipline == "620"){ echo "selected='selected'";} ?>>Wood Science </option>
<option value="621" <?php if(@$FirstDiscipline == "621"){ echo "selected='selected'";} ?>>Zoology</option>

                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												
												<h5 class="divider divider-left">
                                        <div class="divider-text">Option 2:</div>
                                    </h5>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="SecondProvince">Province</label>
                                                        <fieldset class="form-group">
                                                    <select class="choices form-select" id="SecondProvince" name="SecondProvince">
                                                        <option></option>
                                                        <option value="1" <?php if(@$SecondProvince == "1"){ echo "selected='selected'";} ?>>Gauteng</option>
<option value="2" <?php if(@$SecondProvince == "2"){ echo "selected='selected'";} ?>>Free State</option>
<option value="3" <?php if(@$SecondProvince == "3"){ echo "selected='selected'";} ?>>Eastern Cape</option>
<option value="4" <?php if(@$SecondProvince == "4"){ echo "selected='selected'";} ?>>KwaZulu-Natal</option>
<option value="5" <?php if(@$SecondProvince == "5"){ echo "selected='selected'";} ?>>Limpopo</option>
<option value="6" <?php if(@$SecondProvince == "6"){ echo "selected='selected'";} ?>>Mpumalanga</option>
<option value="7" <?php if(@$SecondProvince == "7"){ echo "selected='selected'";} ?>>Northern Cape</option>
<option value="8" <?php if(@$SecondProvince == "8"){ echo "selected='selected'";} ?>>North West</option>
<option value="9" <?php if(@$SecondProvince == "9"){ echo "selected='selected'";} ?>>Western Cape</option>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="SecondDiscipline">Discipline/Area of Specialisation</label>
                                                        <fieldset class="form-group">
                                                    <select class="choices form-select" id="SecondDiscipline" name="SecondDiscipline">
                                                        <option></option>
                                                        <option value="27" <?php if(@$SecondDiscipline == "27"){ echo "selected='selected'";} ?>>Accounting</option>
<option value="28" <?php if(@$SecondDiscipline == "28"){ echo "selected='selected'";} ?>>Accounting and finance</option>
<option value="29" <?php if(@$SecondDiscipline == "29"){ echo "selected='selected'";} ?>>Accounting science</option>
<option value="30" <?php if(@$SecondDiscipline == "30"){ echo "selected='selected'";} ?>>Actuarial Science</option>
<option value="31" <?php if(@$SecondDiscipline == "31"){ echo "selected='selected'";} ?>>Acturial science</option>
<option value="32" <?php if(@$SecondDiscipline == "32"){ echo "selected='selected'";} ?>>additive manufacturing</option>
<option value="33" <?php if(@$SecondDiscipline == "33"){ echo "selected='selected'";} ?>>Administration</option>
<option value="34" <?php if(@$SecondDiscipline == "34"){ echo "selected='selected'";} ?>>Aeronautical and Aerospace</option>
<option value="35" <?php if(@$SecondDiscipline == "35"){ echo "selected='selected'";} ?>>Aeronomy</option>
<option value="36" <?php if(@$SecondDiscipline == "36"){ echo "selected='selected'";} ?>>Aerospace & Aeronautical Engineering</option>
<option value="37" <?php if(@$SecondDiscipline == "37"){ echo "selected='selected'";} ?>>African Languages</option>
<option value="38" <?php if(@$SecondDiscipline == "38"){ echo "selected='selected'";} ?>>AGRI (other)</option>
<option value="39" <?php if(@$SecondDiscipline == "39"){ echo "selected='selected'";} ?>>Agribusiness</option>
<option value="40" <?php if(@$SecondDiscipline == "40"){ echo "selected='selected'";} ?>>Agricultural Biotechnology</option>
<option value="41" <?php if(@$SecondDiscipline == "41"){ echo "selected='selected'";} ?>>Agricultural Economics</option>
<option value="42" <?php if(@$SecondDiscipline == "42"){ echo "selected='selected'";} ?>>Agricultural Engineering</option>
<option value="43" <?php if(@$SecondDiscipline == "43"){ echo "selected='selected'";} ?>>Agricultural Extension</option>
<option value="44" <?php if(@$SecondDiscipline == "44"){ echo "selected='selected'";} ?>>Agricultural Management</option>
<option value="45" <?php if(@$SecondDiscipline == "45"){ echo "selected='selected'";} ?>>Agricultural Resource Management</option>
<option value="46" <?php if(@$SecondDiscipline == "46"){ echo "selected='selected'";} ?>>Agricultural Sciences</option>
<option value="47" <?php if(@$SecondDiscipline == "47"){ echo "selected='selected'";} ?>>Agriculture</option>
<option value="48" <?php if(@$SecondDiscipline == "48"){ echo "selected='selected'";} ?>>Agriculture Economics</option>
<option value="49" <?php if(@$SecondDiscipline == "49"){ echo "selected='selected'";} ?>>Agriculture Education </option>
<option value="50" <?php if(@$SecondDiscipline == "50"){ echo "selected='selected'";} ?>>Agrometeorology</option>
<option value="51" <?php if(@$SecondDiscipline == "51"){ echo "selected='selected'";} ?>>Agrometereology</option>
<option value="52" <?php if(@$SecondDiscipline == "52"){ echo "selected='selected'";} ?>>Agroprocessing</option>
<option value="53" <?php if(@$SecondDiscipline == "53"){ echo "selected='selected'";} ?>>Algebra, Number Theory, and Combinatorics</option>
<option value="54" <?php if(@$SecondDiscipline == "54"){ echo "selected='selected'";} ?>>Algorithms and Theoretical Foundations</option>
<option value="55" <?php if(@$SecondDiscipline == "55"){ echo "selected='selected'";} ?>>Anaesthesia & Pain Management</option>
<option value="56" <?php if(@$SecondDiscipline == "56"){ echo "selected='selected'";} ?>>Anaesthesia and pain management</option>
<option value="57" <?php if(@$SecondDiscipline == "57"){ echo "selected='selected'";} ?>>Analysis</option>
<option value="58" <?php if(@$SecondDiscipline == "58"){ echo "selected='selected'";} ?>>Analytical Chemistry</option>
<option value="59" <?php if(@$SecondDiscipline == "59"){ echo "selected='selected'";} ?>>Anatomical pathology</option>
<option value="60" <?php if(@$SecondDiscipline == "60"){ echo "selected='selected'";} ?>>Anatomical Sciences</option>
<option value="61" <?php if(@$SecondDiscipline == "61"){ echo "selected='selected'";} ?>>Animal and Veterinary Sciences</option>
<option value="62" <?php if(@$SecondDiscipline == "62"){ echo "selected='selected'";} ?>>Animal Breeding & Genetics</option>
<option value="63" <?php if(@$SecondDiscipline == "63"){ echo "selected='selected'";} ?>>Animal Diseases</option>
<option value="64" <?php if(@$SecondDiscipline == "64"){ echo "selected='selected'";} ?>>Animal parasitology</option>
<option value="65" <?php if(@$SecondDiscipline == "65"){ echo "selected='selected'";} ?>>Animal Production</option>
<option value="66" <?php if(@$SecondDiscipline == "66"){ echo "selected='selected'";} ?>>Animal Science</option>
<option value="67" <?php if(@$SecondDiscipline == "67"){ echo "selected='selected'";} ?>>Anthropology</option>
<option value="68" <?php if(@$SecondDiscipline == "68"){ echo "selected='selected'";} ?>>Applied Mathematics</option>
<option value="69" <?php if(@$SecondDiscipline == "69"){ echo "selected='selected'";} ?>>Archaeology</option>
<option value="70" <?php if(@$SecondDiscipline == "70"){ echo "selected='selected'";} ?>>Architecture</option>
<option value="71" <?php if(@$SecondDiscipline == "71"){ echo "selected='selected'";} ?>>Argriculture </option>
<option value="72" <?php if(@$SecondDiscipline == "72"){ echo "selected='selected'";} ?>>Argrometereology</option>
<option value="73" <?php if(@$SecondDiscipline == "73"){ echo "selected='selected'";} ?>>Artifical Intelligence</option>
<option value="74" <?php if(@$SecondDiscipline == "74"){ echo "selected='selected'";} ?>>Artificial intelligence</option>
<option value="75" <?php if(@$SecondDiscipline == "75"){ echo "selected='selected'";} ?>>Arts</option>
<option value="76" <?php if(@$SecondDiscipline == "76"){ echo "selected='selected'";} ?>>Astronomy</option>
<option value="77" <?php if(@$SecondDiscipline == "77"){ echo "selected='selected'";} ?>>Astrophysics</option>
<option value="78" <?php if(@$SecondDiscipline == "78"){ echo "selected='selected'";} ?>>Atmospheric Chemistry</option>
<option value="79" <?php if(@$SecondDiscipline == "79"){ echo "selected='selected'";} ?>>Atmospheric Science & Meteorology</option>
<option value="80" <?php if(@$SecondDiscipline == "80"){ echo "selected='selected'";} ?>>Atomic and Molecular</option>
<option value="81" <?php if(@$SecondDiscipline == "81"){ echo "selected='selected'";} ?>>Atomic, Molecular & Nuclear Physics</option>
<option value="82" <?php if(@$SecondDiscipline == "82"){ echo "selected='selected'";} ?>>Atomic, Molecular, Nuclear Physics</option>
<option value="83" <?php if(@$SecondDiscipline == "83"){ echo "selected='selected'";} ?>>Auditing</option>
<option value="84" <?php if(@$SecondDiscipline == "84"){ echo "selected='selected'";} ?>>Automotive Engineering</option>
<option value="85" <?php if(@$SecondDiscipline == "85"){ echo "selected='selected'";} ?>>Basic and Applied Microbiology</option>
<option value="86" <?php if(@$SecondDiscipline == "86"){ echo "selected='selected'";} ?>>Basic Medical Science</option>
<option value="87" <?php if(@$SecondDiscipline == "87"){ echo "selected='selected'";} ?>>Biochemistry</option>
<option value="88" <?php if(@$SecondDiscipline == "88"){ echo "selected='selected'";} ?>>Bioengineering</option>
<option value="89" <?php if(@$SecondDiscipline == "89"){ echo "selected='selected'";} ?>>Bio-engineering</option>
<option value="90" <?php if(@$SecondDiscipline == "90"){ echo "selected='selected'";} ?>>Biogeochemistry</option>
<option value="91" <?php if(@$SecondDiscipline == "91"){ echo "selected='selected'";} ?>>Bioinformatics</option>
<option value="92" <?php if(@$SecondDiscipline == "92"){ echo "selected='selected'";} ?>>Bioinformatics and Computational Biology</option>
<option value="93" <?php if(@$SecondDiscipline == "93"){ echo "selected='selected'";} ?>>Bioinformatics and other Informatics</option>
<option value="94" <?php if(@$SecondDiscipline == "94"){ echo "selected='selected'";} ?>>Biological Oceanography</option>
<option value="95" <?php if(@$SecondDiscipline == "95"){ echo "selected='selected'";} ?>>Biological science</option>
<option value="96" <?php if(@$SecondDiscipline == "96"){ echo "selected='selected'";} ?>>Biological Sciences</option>
<option value="97" <?php if(@$SecondDiscipline == "97"){ echo "selected='selected'";} ?>>Biology</option>
<option value="98" <?php if(@$SecondDiscipline == "98"){ echo "selected='selected'";} ?>>Biomaterials</option>
<option value="99" <?php if(@$SecondDiscipline == "99"){ echo "selected='selected'";} ?>>Biomedical Technology</option>
<option value="100" <?php if(@$SecondDiscipline == "100"){ echo "selected='selected'";} ?>>Biometrics</option>
<option value="101" <?php if(@$SecondDiscipline == "101"){ echo "selected='selected'";} ?>>Biophysics</option>
<option value="102" <?php if(@$SecondDiscipline == "102"){ echo "selected='selected'";} ?>>Bioprocesses</option>
<option value="103" <?php if(@$SecondDiscipline == "103"){ echo "selected='selected'";} ?>>Biostatistics</option>
<option value="104" <?php if(@$SecondDiscipline == "104"){ echo "selected='selected'";} ?>>Biotechnology</option>
<option value="105" <?php if(@$SecondDiscipline == "105"){ echo "selected='selected'";} ?>>Botany</option>
<option value="106" <?php if(@$SecondDiscipline == "106"){ echo "selected='selected'";} ?>>Business administration</option>
<option value="107" <?php if(@$SecondDiscipline == "107"){ echo "selected='selected'";} ?>>Business economics</option>
<option value="108" <?php if(@$SecondDiscipline == "108"){ echo "selected='selected'";} ?>>Business Sciences </option>
<option value="109" <?php if(@$SecondDiscipline == "109"){ echo "selected='selected'";} ?>>Capital Markets and Investments</option>
<option value="110" <?php if(@$SecondDiscipline == "110"){ echo "selected='selected'";} ?>>Cardiology</option>
<option value="111" <?php if(@$SecondDiscipline == "111"){ echo "selected='selected'";} ?>>Cardiovascular diseases</option>
<option value="112" <?php if(@$SecondDiscipline == "112"){ echo "selected='selected'";} ?>>Cell Biology</option>
<option value="113" <?php if(@$SecondDiscipline == "113"){ echo "selected='selected'";} ?>>Cellular and Molecular Biology</option>
<option value="114" <?php if(@$SecondDiscipline == "114"){ echo "selected='selected'";} ?>>Ceramics</option>
<option value="115" <?php if(@$SecondDiscipline == "115"){ echo "selected='selected'";} ?>>Chemical Catalysis</option>
<option value="116" <?php if(@$SecondDiscipline == "116"){ echo "selected='selected'";} ?>>Chemical Engineering</option>
<option value="117" <?php if(@$SecondDiscipline == "117"){ echo "selected='selected'";} ?>>Chemical Measurement and Imaging</option>
<option value="118" <?php if(@$SecondDiscipline == "118"){ echo "selected='selected'";} ?>>Chemical Oceanography</option>
<option value="119" <?php if(@$SecondDiscipline == "119"){ echo "selected='selected'";} ?>>Chemical Pathology</option>
<option value="120" <?php if(@$SecondDiscipline == "120"){ echo "selected='selected'";} ?>>Chemical Sciences</option>
<option value="121" <?php if(@$SecondDiscipline == "121"){ echo "selected='selected'";} ?>>Chemical Structure, Dynamics, and Mechanism</option>
<option value="122" <?php if(@$SecondDiscipline == "122"){ echo "selected='selected'";} ?>>Chemical Synthesis</option>
<option value="123" <?php if(@$SecondDiscipline == "123"){ echo "selected='selected'";} ?>>Chemical Theory, Models and Computational Methods</option>
<option value="124" <?php if(@$SecondDiscipline == "124"){ echo "selected='selected'";} ?>>Chemistry</option>
<option value="125" <?php if(@$SecondDiscipline == "125"){ echo "selected='selected'";} ?>>Chemistry of Life Processes</option>
<option value="126" <?php if(@$SecondDiscipline == "126"){ echo "selected='selected'";} ?>>Chemistry of materials</option>
<option value="127" <?php if(@$SecondDiscipline == "127"){ echo "selected='selected'";} ?>>Chemistry Sciences Engineering</option>
<option value="128" <?php if(@$SecondDiscipline == "128"){ echo "selected='selected'";} ?>>Circuits</option>
<option value="129" <?php if(@$SecondDiscipline == "129"){ echo "selected='selected'";} ?>>Civil Engineering</option>
<option value="130" <?php if(@$SecondDiscipline == "130"){ echo "selected='selected'";} ?>>Civil procedure and courts</option>
<option value="131" <?php if(@$SecondDiscipline == "131"){ echo "selected='selected'";} ?>>Classics</option>
<option value="132" <?php if(@$SecondDiscipline == "132"){ echo "selected='selected'";} ?>>Climate and Large-Scale Atmospheric Dynamics</option>
<option value="133" <?php if(@$SecondDiscipline == "133"){ echo "selected='selected'";} ?>>Climate Change</option>
<option value="134" <?php if(@$SecondDiscipline == "134"){ echo "selected='selected'";} ?>>Clinical medicine</option>
<option value="135" <?php if(@$SecondDiscipline == "135"){ echo "selected='selected'";} ?>>Collections Management</option>
<option value="136" <?php if(@$SecondDiscipline == "136"){ echo "selected='selected'";} ?>>Commercial Law</option>
<option value="137" <?php if(@$SecondDiscipline == "137"){ echo "selected='selected'";} ?>>Communication</option>
<option value="138" <?php if(@$SecondDiscipline == "138"){ echo "selected='selected'";} ?>>Communication & Media Studies</option>
<option value="139" <?php if(@$SecondDiscipline == "139"){ echo "selected='selected'";} ?>>Communication and Information Theory</option>
<option value="140" <?php if(@$SecondDiscipline == "140"){ echo "selected='selected'";} ?>>Communication Technology</option>
<option value="141" <?php if(@$SecondDiscipline == "141"){ echo "selected='selected'";} ?>>Comparative Law</option>
<option value="142" <?php if(@$SecondDiscipline == "142"){ echo "selected='selected'";} ?>>Computational and Data-enabled Science</option>
<option value="143" <?php if(@$SecondDiscipline == "143"){ echo "selected='selected'";} ?>>Computational Mathematics</option>
<option value="144" <?php if(@$SecondDiscipline == "144"){ echo "selected='selected'";} ?>>Computational Science and Engineering</option>
<option value="145" <?php if(@$SecondDiscipline == "145"){ echo "selected='selected'";} ?>>Computational Statistics</option>
<option value="146" <?php if(@$SecondDiscipline == "146"){ echo "selected='selected'";} ?>>Computer Architecture</option>
<option value="147" <?php if(@$SecondDiscipline == "147"){ echo "selected='selected'";} ?>>Computer Engineering</option>
<option value="148" <?php if(@$SecondDiscipline == "148"){ echo "selected='selected'";} ?>>Computer Hardware</option>
<option value="149" <?php if(@$SecondDiscipline == "149"){ echo "selected='selected'";} ?>>Computer multimedia systems</option>
<option value="150" <?php if(@$SecondDiscipline == "150"){ echo "selected='selected'";} ?>>Computer Networks</option>
<option value="151" <?php if(@$SecondDiscipline == "151"){ echo "selected='selected'";} ?>>Computer Programming</option>
<option value="152" <?php if(@$SecondDiscipline == "152"){ echo "selected='selected'";} ?>>Computer Science and Information Systems</option>
<option value="153" <?php if(@$SecondDiscipline == "153"){ echo "selected='selected'";} ?>>Computer Security and Privacy</option>
<option value="154" <?php if(@$SecondDiscipline == "154"){ echo "selected='selected'";} ?>>Computer Software</option>
<option value="155" <?php if(@$SecondDiscipline == "155"){ echo "selected='selected'";} ?>>Computer Systems and Embedded Systems</option>
<option value="156" <?php if(@$SecondDiscipline == "156"){ echo "selected='selected'";} ?>>Condensed Matter</option>
<option value="157" <?php if(@$SecondDiscipline == "157"){ echo "selected='selected'";} ?>>Constitutional and administrative law</option>
<option value="158" <?php if(@$SecondDiscipline == "158"){ echo "selected='selected'";} ?>>Construction & Building</option>
<option value="159" <?php if(@$SecondDiscipline == "159"){ echo "selected='selected'";} ?>>Construction Industry & Building</option>
<option value="160" <?php if(@$SecondDiscipline == "160"){ echo "selected='selected'";} ?>>Construction industry and building</option>
<option value="161" <?php if(@$SecondDiscipline == "161"){ echo "selected='selected'";} ?>>Corporate governance</option>
<option value="162" <?php if(@$SecondDiscipline == "162"){ echo "selected='selected'";} ?>>Creative Arts</option>
<option value="163" <?php if(@$SecondDiscipline == "163"){ echo "selected='selected'";} ?>>Criminal law</option>
<option value="164" <?php if(@$SecondDiscipline == "164"){ echo "selected='selected'";} ?>>Criminology</option>
<option value="165" <?php if(@$SecondDiscipline == "165"){ echo "selected='selected'";} ?>>CRM (other)</option>
<option value="166" <?php if(@$SecondDiscipline == "166"){ echo "selected='selected'";} ?>>Cultural studies</option>
<option value="167" <?php if(@$SecondDiscipline == "167"){ echo "selected='selected'";} ?>>Customary law</option>
<option value="168" <?php if(@$SecondDiscipline == "168"){ echo "selected='selected'";} ?>>Dairy Science</option>
<option value="169" <?php if(@$SecondDiscipline == "169"){ echo "selected='selected'";} ?>>Data Mining and Information Retrieval</option>
<option value="170" <?php if(@$SecondDiscipline == "170"){ echo "selected='selected'";} ?>>Databases</option>
<option value="171" <?php if(@$SecondDiscipline == "171"){ echo "selected='selected'";} ?>>Decorative arts</option>
<option value="172" <?php if(@$SecondDiscipline == "172"){ echo "selected='selected'";} ?>>Degenerative diseases</option>
<option value="173" <?php if(@$SecondDiscipline == "173"){ echo "selected='selected'";} ?>>Demography</option>
<option value="174" <?php if(@$SecondDiscipline == "174"){ echo "selected='selected'";} ?>>Dental Sciences</option>
<option value="175" <?php if(@$SecondDiscipline == "175"){ echo "selected='selected'";} ?>>Dermatology</option>
<option value="176" <?php if(@$SecondDiscipline == "176"){ echo "selected='selected'";} ?>>Design studies</option>
<option value="177" <?php if(@$SecondDiscipline == "177"){ echo "selected='selected'";} ?>>Development Studies</option>
<option value="178" <?php if(@$SecondDiscipline == "178"){ echo "selected='selected'";} ?>>Developmental Biology</option>
<option value="179" <?php if(@$SecondDiscipline == "179"){ echo "selected='selected'";} ?>>Developmental Studies</option>
<option value="180" <?php if(@$SecondDiscipline == "180"){ echo "selected='selected'";} ?>>Diabetology</option>
<option value="181" <?php if(@$SecondDiscipline == "181"){ echo "selected='selected'";} ?>>Dietetics</option>
<option value="182" <?php if(@$SecondDiscipline == "182"){ echo "selected='selected'";} ?>>Dietetics </option>
<option value="183" <?php if(@$SecondDiscipline == "183"){ echo "selected='selected'";} ?>>Diffusion</option>
<option value="184" <?php if(@$SecondDiscipline == "184"){ echo "selected='selected'";} ?>>Dramatic arts</option>
<option value="185" <?php if(@$SecondDiscipline == "185"){ echo "selected='selected'";} ?>>Drug discovery</option>
<option value="186" <?php if(@$SecondDiscipline == "186"){ echo "selected='selected'";} ?>>Drug Discovery and Development</option>
<option value="187" <?php if(@$SecondDiscipline == "187"){ echo "selected='selected'";} ?>>Earth and Related Environmental sciences</option>
<option value="188" <?php if(@$SecondDiscipline == "188"){ echo "selected='selected'";} ?>>Earth Observation</option>
<option value="189" <?php if(@$SecondDiscipline == "189"){ echo "selected='selected'";} ?>>Earth Science</option>
<option value="190" <?php if(@$SecondDiscipline == "190"){ echo "selected='selected'";} ?>>Earth Sciences</option>
<option value="191" <?php if(@$SecondDiscipline == "191"){ echo "selected='selected'";} ?>>Ecology</option>
<option value="192" <?php if(@$SecondDiscipline == "192"){ echo "selected='selected'";} ?>>Ecology & Env Science</option>
<option value="193" <?php if(@$SecondDiscipline == "193"){ echo "selected='selected'";} ?>>Ecology & Enviromental Science</option>
<option value="194" <?php if(@$SecondDiscipline == "194"){ echo "selected='selected'";} ?>>Ecology & Environmental Science</option>
<option value="195" <?php if(@$SecondDiscipline == "195"){ echo "selected='selected'";} ?>>Ecology & Environmental Sciences</option>
<option value="196" <?php if(@$SecondDiscipline == "196"){ echo "selected='selected'";} ?>>Economic Sciences</option>
<option value="197" <?php if(@$SecondDiscipline == "197"){ echo "selected='selected'";} ?>>Economics</option>
<option value="198" <?php if(@$SecondDiscipline == "198"){ echo "selected='selected'";} ?>>Education</option>
<option value="199" <?php if(@$SecondDiscipline == "199"){ echo "selected='selected'";} ?>>Education </option>
<option value="200" <?php if(@$SecondDiscipline == "200"){ echo "selected='selected'";} ?>>Elasticity</option>
<option value="201" <?php if(@$SecondDiscipline == "201"){ echo "selected='selected'";} ?>>Electrical Engineering</option>
<option value="202" <?php if(@$SecondDiscipline == "202"){ echo "selected='selected'";} ?>>Electromagnetism</option>
<option value="203" <?php if(@$SecondDiscipline == "203"){ echo "selected='selected'";} ?>>Electronic Engineering</option>
<option value="204" <?php if(@$SecondDiscipline == "204"){ echo "selected='selected'";} ?>>Electronic materials</option>
<option value="205" <?php if(@$SecondDiscipline == "205"){ echo "selected='selected'";} ?>>Electronics Engineering</option>
<option value="206" <?php if(@$SecondDiscipline == "206"){ echo "selected='selected'";} ?>>EMAS (other)</option>
<option value="207" <?php if(@$SecondDiscipline == "207"){ echo "selected='selected'";} ?>>Embryology & Fetal Development</option>
<option value="208" <?php if(@$SecondDiscipline == "208"){ echo "selected='selected'";} ?>>Endocrinology</option>
<option value="209" <?php if(@$SecondDiscipline == "209"){ echo "selected='selected'";} ?>>Energy</option>
<option value="210" <?php if(@$SecondDiscipline == "210"){ echo "selected='selected'";} ?>>Energy Efficiency</option>
<option value="211" <?php if(@$SecondDiscipline == "211"){ echo "selected='selected'";} ?>>ENG (other)</option>
<option value="212" <?php if(@$SecondDiscipline == "212"){ echo "selected='selected'";} ?>>Engineering</option>
<option value="213" <?php if(@$SecondDiscipline == "213"){ echo "selected='selected'";} ?>>Engineering Education</option>
<option value="214" <?php if(@$SecondDiscipline == "214"){ echo "selected='selected'";} ?>>Engineering Management</option>
<option value="215" <?php if(@$SecondDiscipline == "215"){ echo "selected='selected'";} ?>>Engineering Sciences</option>
<option value="216" <?php if(@$SecondDiscipline == "216"){ echo "selected='selected'";} ?>>Entomology</option>
<option value="217" <?php if(@$SecondDiscipline == "217"){ echo "selected='selected'";} ?>>Enviromental Engineering</option>
<option value="218" <?php if(@$SecondDiscipline == "218"){ echo "selected='selected'";} ?>>Enviromental Studies</option>
<option value="219" <?php if(@$SecondDiscipline == "219"){ echo "selected='selected'";} ?>>Environment</option>
<option value="220" <?php if(@$SecondDiscipline == "220"){ echo "selected='selected'";} ?>>Environment Sciences</option>
<option value="221" <?php if(@$SecondDiscipline == "221"){ echo "selected='selected'";} ?>>Environmental and Earth Sciences</option>
<option value="222" <?php if(@$SecondDiscipline == "222"){ echo "selected='selected'";} ?>>Environmental Biology</option>
<option value="223" <?php if(@$SecondDiscipline == "223"){ echo "selected='selected'";} ?>>Environmental biotechnology</option>
<option value="224" <?php if(@$SecondDiscipline == "224"){ echo "selected='selected'";} ?>>Environmental Chemical Systems</option>
<option value="225" <?php if(@$SecondDiscipline == "225"){ echo "selected='selected'";} ?>>Environmental Engineering</option>
<option value="226" <?php if(@$SecondDiscipline == "226"){ echo "selected='selected'";} ?>>Environmental Health</option>
<option value="227" <?php if(@$SecondDiscipline == "227"){ echo "selected='selected'";} ?>>Environmental Health </option>
<option value="228" <?php if(@$SecondDiscipline == "228"){ echo "selected='selected'";} ?>>Environmental Sciences</option>
<option value="229" <?php if(@$SecondDiscipline == "229"){ echo "selected='selected'";} ?>>Environmental Studies</option>
<option value="230" <?php if(@$SecondDiscipline == "230"){ echo "selected='selected'";} ?>>Epidemiology</option>
<option value="231" <?php if(@$SecondDiscipline == "231"){ echo "selected='selected'";} ?>>Epidemiology </option>
<option value="232" <?php if(@$SecondDiscipline == "232"){ echo "selected='selected'";} ?>>Epidemiology, incl. burden of disease</option>
<option value="233" <?php if(@$SecondDiscipline == "233"){ echo "selected='selected'";} ?>>Ergonomics and Sports science</option>
<option value="234" <?php if(@$SecondDiscipline == "234"){ echo "selected='selected'";} ?>>Ethics</option>
<option value="235" <?php if(@$SecondDiscipline == "235"){ echo "selected='selected'";} ?>>Evolution and developmental biology</option>
<option value="236" <?php if(@$SecondDiscipline == "236"){ echo "selected='selected'";} ?>>Evolutionary Biology</option>
<option value="237" <?php if(@$SecondDiscipline == "237"){ echo "selected='selected'";} ?>>Financial Management</option>
<option value="238" <?php if(@$SecondDiscipline == "238"){ echo "selected='selected'";} ?>>Fine arts</option>
<option value="239" <?php if(@$SecondDiscipline == "239"){ echo "selected='selected'";} ?>>Fisheries</option>
<option value="240" <?php if(@$SecondDiscipline == "240"){ echo "selected='selected'";} ?>>Fisheries </option>
<option value="241" <?php if(@$SecondDiscipline == "241"){ echo "selected='selected'";} ?>>Fluids  </option>
<option value="242" <?php if(@$SecondDiscipline == "242"){ echo "selected='selected'";} ?>>Food Science & Technology</option>
<option value="243" <?php if(@$SecondDiscipline == "243"){ echo "selected='selected'";} ?>>Food Sciences & Technologies</option>
<option value="244" <?php if(@$SecondDiscipline == "244"){ echo "selected='selected'";} ?>>Food Sciences & Technology</option>
<option value="245" <?php if(@$SecondDiscipline == "245"){ echo "selected='selected'";} ?>>Food sciences and technology</option>
<option value="246" <?php if(@$SecondDiscipline == "246"){ echo "selected='selected'";} ?>>Food Technology</option>
<option value="247" <?php if(@$SecondDiscipline == "247"){ echo "selected='selected'";} ?>>Forensic Sciences</option>
<option value="248" <?php if(@$SecondDiscipline == "248"){ echo "selected='selected'";} ?>>Forest Science</option>
<option value="249" <?php if(@$SecondDiscipline == "249"){ echo "selected='selected'";} ?>>Forestry</option>
<option value="250" <?php if(@$SecondDiscipline == "250"){ echo "selected='selected'";} ?>>Formal Methods, Verification, and Programming Languages</option>
<option value="251" <?php if(@$SecondDiscipline == "251"){ echo "selected='selected'";} ?>>Fresh Water Biology</option>
<option value="252" <?php if(@$SecondDiscipline == "252"){ echo "selected='selected'";} ?>>Fresh Water Biology & Limnology</option>
<option value="253" <?php if(@$SecondDiscipline == "253"){ echo "selected='selected'";} ?>>Functional Genomics</option>
<option value="254" <?php if(@$SecondDiscipline == "254"){ echo "selected='selected'";} ?>>Game Ranching & Farming</option>
<option value="255" <?php if(@$SecondDiscipline == "255"){ echo "selected='selected'";} ?>>Game ranching and farming</option>
<option value="256" <?php if(@$SecondDiscipline == "256"){ echo "selected='selected'";} ?>>Gastrointestinal diseases</option>
<option value="257" <?php if(@$SecondDiscipline == "257"){ echo "selected='selected'";} ?>>General practice</option>
<option value="258" <?php if(@$SecondDiscipline == "258"){ echo "selected='selected'";} ?>>Genetics</option>
<option value="259" <?php if(@$SecondDiscipline == "259"){ echo "selected='selected'";} ?>>Genito-urinary diseases (incl. Urology)</option>
<option value="260" <?php if(@$SecondDiscipline == "260"){ echo "selected='selected'";} ?>>Genomic biology</option>
<option value="261" <?php if(@$SecondDiscipline == "261"){ echo "selected='selected'";} ?>>Genomics</option>
<option value="262" <?php if(@$SecondDiscipline == "262"){ echo "selected='selected'";} ?>>Geobiology</option>
<option value="263" <?php if(@$SecondDiscipline == "263"){ echo "selected='selected'";} ?>>Geochemistry</option>
<option value="264" <?php if(@$SecondDiscipline == "264"){ echo "selected='selected'";} ?>>Geodynamics</option>
<option value="265" <?php if(@$SecondDiscipline == "265"){ echo "selected='selected'";} ?>>Geographic Information Science</option>
<option value="266" <?php if(@$SecondDiscipline == "266"){ echo "selected='selected'";} ?>>Geographic Information Systems</option>
<option value="267" <?php if(@$SecondDiscipline == "267"){ echo "selected='selected'";} ?>>Geography</option>
<option value="268" <?php if(@$SecondDiscipline == "268"){ echo "selected='selected'";} ?>>Geohydrology</option>
<option value="269" <?php if(@$SecondDiscipline == "269"){ echo "selected='selected'";} ?>>Geology</option>
<option value="270" <?php if(@$SecondDiscipline == "270"){ echo "selected='selected'";} ?>>Geometric Analysis</option>
<option value="271" <?php if(@$SecondDiscipline == "271"){ echo "selected='selected'";} ?>>Geomorphology</option>
<option value="272" <?php if(@$SecondDiscipline == "272"){ echo "selected='selected'";} ?>>Geophysics</option>
<option value="273" <?php if(@$SecondDiscipline == "273"){ echo "selected='selected'";} ?>>Geosciences (other)</option>
<option value="274" <?php if(@$SecondDiscipline == "274"){ echo "selected='selected'";} ?>>Geospace Physics</option>
<option value="275" <?php if(@$SecondDiscipline == "275"){ echo "selected='selected'";} ?>>Geriatrics</option>
<option value="276" <?php if(@$SecondDiscipline == "276"){ echo "selected='selected'";} ?>>Glaciology</option>
<option value="277" <?php if(@$SecondDiscipline == "277"){ echo "selected='selected'";} ?>>Global Change, Society and Sustainability</option>
<option value="278" <?php if(@$SecondDiscipline == "278"){ echo "selected='selected'";} ?>>GMS (other)</option>
<option value="279" <?php if(@$SecondDiscipline == "279"){ echo "selected='selected'";} ?>>Graphics and Visualization</option>
<option value="280" <?php if(@$SecondDiscipline == "280"){ echo "selected='selected'";} ?>>Gynaecology</option>
<option value="281" <?php if(@$SecondDiscipline == "281"){ echo "selected='selected'";} ?>>Haematology</option>
<option value="282" <?php if(@$SecondDiscipline == "282"){ echo "selected='selected'";} ?>>Health</option>
<option value="283" <?php if(@$SecondDiscipline == "283"){ echo "selected='selected'";} ?>>Health Economics</option>
<option value="284" <?php if(@$SecondDiscipline == "284"){ echo "selected='selected'";} ?>>Health Informatics</option>
<option value="285" <?php if(@$SecondDiscipline == "285"){ echo "selected='selected'";} ?>>Health Promotion</option>
<option value="286" <?php if(@$SecondDiscipline == "286"){ echo "selected='selected'";} ?>>Health Promotion </option>
<option value="287" <?php if(@$SecondDiscipline == "287"){ echo "selected='selected'";} ?>>Health promotion &  Diesease Prevention</option>
<option value="288" <?php if(@$SecondDiscipline == "288"){ echo "selected='selected'";} ?>>Health Promotion & Diease Prevention</option>
<option value="289" <?php if(@$SecondDiscipline == "289"){ echo "selected='selected'";} ?>>Health Promotion & Disease Prevention</option>
<option value="290" <?php if(@$SecondDiscipline == "290"){ echo "selected='selected'";} ?>>Health Sciences</option>
<option value="291" <?php if(@$SecondDiscipline == "291"){ echo "selected='selected'";} ?>>Health Systems & Research</option>
<option value="292" <?php if(@$SecondDiscipline == "292"){ echo "selected='selected'";} ?>>Health Systems Research</option>
<option value="293" <?php if(@$SecondDiscipline == "293"){ echo "selected='selected'";} ?>>Health Technology</option>
<option value="294" <?php if(@$SecondDiscipline == "294"){ echo "selected='selected'";} ?>>Heath Economics</option>
<option value="295" <?php if(@$SecondDiscipline == "295"){ echo "selected='selected'";} ?>>Historical studies</option>
<option value="296" <?php if(@$SecondDiscipline == "296"){ echo "selected='selected'";} ?>>History of arts</option>
<option value="297" <?php if(@$SecondDiscipline == "297"){ echo "selected='selected'";} ?>>HMS (other)</option>
<option value="298" <?php if(@$SecondDiscipline == "298"){ echo "selected='selected'";} ?>>Home economics</option>
<option value="299" <?php if(@$SecondDiscipline == "299"){ echo "selected='selected'";} ?>>Horticulture</option>
<option value="300" <?php if(@$SecondDiscipline == "300"){ echo "selected='selected'";} ?>>Horticulture </option>
<option value="301" <?php if(@$SecondDiscipline == "301"){ echo "selected='selected'";} ?>>Human anatomy and physiology</option>
<option value="302" <?php if(@$SecondDiscipline == "302"){ echo "selected='selected'";} ?>>Human Computer Interaction</option>
<option value="303" <?php if(@$SecondDiscipline == "303"){ echo "selected='selected'";} ?>>Human geography</option>
<option value="304" <?php if(@$SecondDiscipline == "304"){ echo "selected='selected'";} ?>>Human Movement science</option>
<option value="305" <?php if(@$SecondDiscipline == "305"){ echo "selected='selected'";} ?>>Human Movement Sciences</option>
<option value="306" <?php if(@$SecondDiscipline == "306"){ echo "selected='selected'";} ?>>Human Physiology</option>
<option value="307" <?php if(@$SecondDiscipline == "307"){ echo "selected='selected'";} ?>>Human Resources</option>
<option value="308" <?php if(@$SecondDiscipline == "308"){ echo "selected='selected'";} ?>>Human Systems Research</option>
<option value="309" <?php if(@$SecondDiscipline == "309"){ echo "selected='selected'";} ?>>Humanities</option>
<option value="310" <?php if(@$SecondDiscipline == "310"){ echo "selected='selected'";} ?>>Humanities and Arts</option>
<option value="311" <?php if(@$SecondDiscipline == "311"){ echo "selected='selected'";} ?>>Hydrology</option>
<option value="312" <?php if(@$SecondDiscipline == "312"){ echo "selected='selected'";} ?>>ICT</option>
<option value="313" <?php if(@$SecondDiscipline == "313"){ echo "selected='selected'";} ?>>Immunology</option>
<option value="314" <?php if(@$SecondDiscipline == "314"){ echo "selected='selected'";} ?>>Immunology, Virology and Infectious diseases</option>
<option value="315" <?php if(@$SecondDiscipline == "315"){ echo "selected='selected'";} ?>>Indigenous Knowledge Systems</option>
<option value="316" <?php if(@$SecondDiscipline == "316"){ echo "selected='selected'";} ?>>Industrial Biotechnology</option>
<option value="317" <?php if(@$SecondDiscipline == "317"){ echo "selected='selected'";} ?>>Industrial design</option>
<option value="318" <?php if(@$SecondDiscipline == "318"){ echo "selected='selected'";} ?>>Industrial Engineering</option>
<option value="319" <?php if(@$SecondDiscipline == "319"){ echo "selected='selected'";} ?>>Industrial Engineering & Operations Research</option>
<option value="320" <?php if(@$SecondDiscipline == "320"){ echo "selected='selected'";} ?>>Industrial Psychology</option>
<option value="321" <?php if(@$SecondDiscipline == "321"){ echo "selected='selected'";} ?>>Industrial Psychology & Sociology</option>
<option value="322" <?php if(@$SecondDiscipline == "322"){ echo "selected='selected'";} ?>>Infectious Diseases</option>
<option value="323" <?php if(@$SecondDiscipline == "323"){ echo "selected='selected'";} ?>>Infomation Systems & Technologies</option>
<option value="324" <?php if(@$SecondDiscipline == "324"){ echo "selected='selected'";} ?>>Information  & Computer Technologies</option>
<option value="325" <?php if(@$SecondDiscipline == "325"){ echo "selected='selected'";} ?>>Information & Computer Science</option>
<option value="326" <?php if(@$SecondDiscipline == "326"){ echo "selected='selected'";} ?>>Information & Computer Sciences</option>
<option value="327" <?php if(@$SecondDiscipline == "327"){ echo "selected='selected'";} ?>>Information & Computer Technologies</option>
<option value="328" <?php if(@$SecondDiscipline == "328"){ echo "selected='selected'";} ?>>Information & Computer Technology</option>
<option value="329" <?php if(@$SecondDiscipline == "329"){ echo "selected='selected'";} ?>>Information & Library Science</option>
<option value="330" <?php if(@$SecondDiscipline == "330"){ echo "selected='selected'";} ?>>Information & Library Sciences</option>
<option value="331" <?php if(@$SecondDiscipline == "331"){ echo "selected='selected'";} ?>>Information and Communication Technology (ICT)</option>
<option value="332" <?php if(@$SecondDiscipline == "332"){ echo "selected='selected'";} ?>>Information and Computer science</option>
<option value="333" <?php if(@$SecondDiscipline == "333"){ echo "selected='selected'";} ?>>Information Communication Technology</option>
<option value="334" <?php if(@$SecondDiscipline == "334"){ echo "selected='selected'";} ?>>Information Engineering</option>
<option value="335" <?php if(@$SecondDiscipline == "335"){ echo "selected='selected'";} ?>>Information Management</option>
<option value="336" <?php if(@$SecondDiscipline == "336"){ echo "selected='selected'";} ?>>Information Mangagement</option>
<option value="337" <?php if(@$SecondDiscipline == "337"){ echo "selected='selected'";} ?>>Information Science</option>
<option value="338" <?php if(@$SecondDiscipline == "338"){ echo "selected='selected'";} ?>>Information Systems</option>
<option value="339" <?php if(@$SecondDiscipline == "339"){ echo "selected='selected'";} ?>>Information Systems & Technologies</option>
<option value="340" <?php if(@$SecondDiscipline == "340"){ echo "selected='selected'";} ?>>Information Systems & Technology</option>
<option value="341" <?php if(@$SecondDiscipline == "341"){ echo "selected='selected'";} ?>>Information Technology</option>
<option value="342" <?php if(@$SecondDiscipline == "342"){ echo "selected='selected'";} ?>>Information, Communication, Control Systems</option>
<option value="343" <?php if(@$SecondDiscipline == "343"){ echo "selected='selected'";} ?>>Informations Systems</option>
<option value="344" <?php if(@$SecondDiscipline == "344"){ echo "selected='selected'";} ?>>Innovation & Technology Transfer</option>
<option value="345" <?php if(@$SecondDiscipline == "345"){ echo "selected='selected'";} ?>>Inorganic Chemistry</option>
<option value="346" <?php if(@$SecondDiscipline == "346"){ echo "selected='selected'";} ?>>Intensive care</option>
<option value="347" <?php if(@$SecondDiscipline == "347"){ echo "selected='selected'";} ?>>International law</option>
<option value="348" <?php if(@$SecondDiscipline == "348"){ echo "selected='selected'";} ?>>International Relations</option>
<option value="349" <?php if(@$SecondDiscipline == "349"){ echo "selected='selected'";} ?>>Invertebrate Taxonomy</option>
<option value="350" <?php if(@$SecondDiscipline == "350"){ echo "selected='selected'";} ?>>IT Graphic Design</option>
<option value="351" <?php if(@$SecondDiscipline == "351"){ echo "selected='selected'";} ?>>IT-Graphic Design</option>
<option value="352" <?php if(@$SecondDiscipline == "352"){ echo "selected='selected'";} ?>>Jurisprudence</option>
<option value="353" <?php if(@$SecondDiscipline == "353"){ echo "selected='selected'";} ?>>Knowledge Management (Records Administration)</option>
<option value="354" <?php if(@$SecondDiscipline == "354"){ echo "selected='selected'";} ?>>Labour, social service, education and cultural law</option>
<option value="355" <?php if(@$SecondDiscipline == "355"){ echo "selected='selected'";} ?>>Languages</option>
<option value="356" <?php if(@$SecondDiscipline == "356"){ echo "selected='selected'";} ?>>Languages & Literature</option>
<option value="357" <?php if(@$SecondDiscipline == "357"){ echo "selected='selected'";} ?>>Languages and literature</option>
<option value="358" <?php if(@$SecondDiscipline == "358"){ echo "selected='selected'";} ?>>Law</option>
<option value="359" <?php if(@$SecondDiscipline == "359"){ echo "selected='selected'";} ?>>Laws (Statutes), regulations, cases</option>
<option value="360" <?php if(@$SecondDiscipline == "360"){ echo "selected='selected'";} ?>>Leadership</option>
<option value="361" <?php if(@$SecondDiscipline == "361"){ echo "selected='selected'";} ?>>Legal history</option>
<option value="362" <?php if(@$SecondDiscipline == "362"){ echo "selected='selected'";} ?>>Librarianship</option>
<option value="363" <?php if(@$SecondDiscipline == "363"){ echo "selected='selected'";} ?>>Library and Information Sciences</option>
<option value="364" <?php if(@$SecondDiscipline == "364"){ echo "selected='selected'";} ?>>Library Science</option>
<option value="365" <?php if(@$SecondDiscipline == "365"){ echo "selected='selected'";} ?>>Library Sciences</option>
<option value="366" <?php if(@$SecondDiscipline == "366"){ echo "selected='selected'";} ?>>Library Services</option>
<option value="367" <?php if(@$SecondDiscipline == "367"){ echo "selected='selected'";} ?>>Limnology</option>
<option value="368" <?php if(@$SecondDiscipline == "368"){ echo "selected='selected'";} ?>>Linguistics</option>
<option value="369" <?php if(@$SecondDiscipline == "369"){ echo "selected='selected'";} ?>>Literature</option>
<option value="370" <?php if(@$SecondDiscipline == "370"){ echo "selected='selected'";} ?>>Logic or Foundations of Mathematics</option>
<option value="371" <?php if(@$SecondDiscipline == "371"){ echo "selected='selected'";} ?>>Machine Learning</option>
<option value="372" <?php if(@$SecondDiscipline == "372"){ echo "selected='selected'";} ?>>Macro-Invertebrates</option>
<option value="373" <?php if(@$SecondDiscipline == "373"){ echo "selected='selected'";} ?>>Macromolecular, Supramolecular, and Nanochemistry</option>
<option value="374" <?php if(@$SecondDiscipline == "374"){ echo "selected='selected'";} ?>>Magnetospheric Physics</option>
<option value="375" <?php if(@$SecondDiscipline == "375"){ echo "selected='selected'";} ?>>Management</option>
<option value="376" <?php if(@$SecondDiscipline == "376"){ echo "selected='selected'";} ?>>Management Sciences</option>
<option value="377" <?php if(@$SecondDiscipline == "377"){ echo "selected='selected'";} ?>>Management Studies</option>
<option value="378" <?php if(@$SecondDiscipline == "378"){ echo "selected='selected'";} ?>>Manufacturing & Process Techniques</option>
<option value="379" <?php if(@$SecondDiscipline == "379"){ echo "selected='selected'";} ?>>Manufacturing & Process Technologies</option>
<option value="380" <?php if(@$SecondDiscipline == "380"){ echo "selected='selected'";} ?>>Marine Biology</option>
<option value="381" <?php if(@$SecondDiscipline == "381"){ echo "selected='selected'";} ?>>Marine Engineering & Naval Architecture</option>
<option value="382" <?php if(@$SecondDiscipline == "382"){ echo "selected='selected'";} ?>>Marine engineering and navel architecture</option>
<option value="383" <?php if(@$SecondDiscipline == "383"){ echo "selected='selected'";} ?>>Marine Geology and Geophysics</option>
<option value="384" <?php if(@$SecondDiscipline == "384"){ echo "selected='selected'";} ?>>Marine Sciences</option>
<option value="385" <?php if(@$SecondDiscipline == "385"){ echo "selected='selected'";} ?>>Marketing</option>
<option value="386" <?php if(@$SecondDiscipline == "386"){ echo "selected='selected'";} ?>>Material Science & Technologies</option>
<option value="387" <?php if(@$SecondDiscipline == "387"){ echo "selected='selected'";} ?>>Material Sciences & Technologies</option>
<option value="388" <?php if(@$SecondDiscipline == "388"){ echo "selected='selected'";} ?>>Materials and Manufacturing</option>
<option value="389" <?php if(@$SecondDiscipline == "389"){ echo "selected='selected'";} ?>>Materials engineering</option>
<option value="390" <?php if(@$SecondDiscipline == "390"){ echo "selected='selected'";} ?>>Materials theory and Research</option>
<option value="391" <?php if(@$SecondDiscipline == "391"){ echo "selected='selected'";} ?>>Mathematical Biology</option>
<option value="392" <?php if(@$SecondDiscipline == "392"){ echo "selected='selected'";} ?>>Mathematical Science</option>
<option value="393" <?php if(@$SecondDiscipline == "393"){ echo "selected='selected'";} ?>>Mathematical Sciences</option>
<option value="394" <?php if(@$SecondDiscipline == "394"){ echo "selected='selected'";} ?>>Mathematics</option>
<option value="395" <?php if(@$SecondDiscipline == "395"){ echo "selected='selected'";} ?>>Mathematics (other)</option>
<option value="396" <?php if(@$SecondDiscipline == "396"){ echo "selected='selected'";} ?>>Mathematics Education</option>
<option value="397" <?php if(@$SecondDiscipline == "397"){ echo "selected='selected'";} ?>>Mechanical Engineering</option>
<option value="398" <?php if(@$SecondDiscipline == "398"){ echo "selected='selected'";} ?>>Mechanics</option>
<option value="399" <?php if(@$SecondDiscipline == "399"){ echo "selected='selected'";} ?>>Mechnical Engineering</option>
<option value="400" <?php if(@$SecondDiscipline == "400"){ echo "selected='selected'";} ?>>Media & Communications</option>
<option value="401" <?php if(@$SecondDiscipline == "401"){ echo "selected='selected'";} ?>>Media Studies</option>
<option value="402" <?php if(@$SecondDiscipline == "402"){ echo "selected='selected'";} ?>>Medical Biotechnology</option>
<option value="403" <?php if(@$SecondDiscipline == "403"){ echo "selected='selected'";} ?>>Medical engineering</option>
<option value="404" <?php if(@$SecondDiscipline == "404"){ echo "selected='selected'";} ?>>Medical Microbiology</option>
<option value="405" <?php if(@$SecondDiscipline == "405"){ echo "selected='selected'";} ?>>Medical Microbiology </option>
<option value="406" <?php if(@$SecondDiscipline == "406"){ echo "selected='selected'";} ?>>Medical Sciences</option>
<option value="407" <?php if(@$SecondDiscipline == "407"){ echo "selected='selected'";} ?>>Medical sciences: Basic</option>
<option value="408" <?php if(@$SecondDiscipline == "408"){ echo "selected='selected'";} ?>>Medical sciences: Clinical</option>
<option value="409" <?php if(@$SecondDiscipline == "409"){ echo "selected='selected'";} ?>>Medical Technologies</option>
<option value="410" <?php if(@$SecondDiscipline == "410"){ echo "selected='selected'";} ?>>Medical Virology</option>
<option value="411" <?php if(@$SecondDiscipline == "411"){ echo "selected='selected'";} ?>>Medicinal Plant Research</option>
<option value="412" <?php if(@$SecondDiscipline == "412"){ echo "selected='selected'";} ?>>Mental Health & Substance Abuse</option>
<option value="413" <?php if(@$SecondDiscipline == "413"){ echo "selected='selected'";} ?>>Mental health and substance abuse</option>
<option value="414" <?php if(@$SecondDiscipline == "414"){ echo "selected='selected'";} ?>>Metabolic diseases</option>
<option value="415" <?php if(@$SecondDiscipline == "415"){ echo "selected='selected'";} ?>>Metallic materials</option>
<option value="416" <?php if(@$SecondDiscipline == "416"){ echo "selected='selected'";} ?>>Metallurgical Engineering</option>
<option value="417" <?php if(@$SecondDiscipline == "417"){ echo "selected='selected'";} ?>>Microbiology</option>
<option value="418" <?php if(@$SecondDiscipline == "418"){ echo "selected='selected'";} ?>>Military and defence law</option>
<option value="419" <?php if(@$SecondDiscipline == "419"){ echo "selected='selected'";} ?>>Mining and Mineral Processing</option>
<option value="420" <?php if(@$SecondDiscipline == "420"){ echo "selected='selected'";} ?>>Mining engineering</option>
<option value="421" <?php if(@$SecondDiscipline == "421"){ echo "selected='selected'";} ?>>Molecular & Cell Biology</option>
<option value="422" <?php if(@$SecondDiscipline == "422"){ echo "selected='selected'";} ?>>Molecular and Cell Biology</option>
<option value="423" <?php if(@$SecondDiscipline == "423"){ echo "selected='selected'";} ?>>Molecular cell biology</option>
<option value="424" <?php if(@$SecondDiscipline == "424"){ echo "selected='selected'";} ?>>Molecular modelling</option>
<option value="425" <?php if(@$SecondDiscipline == "425"){ echo "selected='selected'";} ?>>Morphology</option>
<option value="426" <?php if(@$SecondDiscipline == "426"){ echo "selected='selected'";} ?>>Music</option>
<option value="427" <?php if(@$SecondDiscipline == "427"){ echo "selected='selected'";} ?>>Musicology</option>
<option value="428" <?php if(@$SecondDiscipline == "428"){ echo "selected='selected'";} ?>>Nanotechnology</option>
<option value="429" <?php if(@$SecondDiscipline == "429"){ echo "selected='selected'";} ?>>Natural Language Processing</option>
<option value="430" <?php if(@$SecondDiscipline == "430"){ echo "selected='selected'";} ?>>Natural Science</option>
<option value="431" <?php if(@$SecondDiscipline == "431"){ echo "selected='selected'";} ?>>Natural Sciences</option>
<option value="432" <?php if(@$SecondDiscipline == "432"){ echo "selected='selected'";} ?>>Neurology</option>
<option value="433" <?php if(@$SecondDiscipline == "433"){ echo "selected='selected'";} ?>>Neurology and Psychiatry</option>
<option value="434" <?php if(@$SecondDiscipline == "434"){ echo "selected='selected'";} ?>>Neuroscience</option>
<option value="435" <?php if(@$SecondDiscipline == "435"){ echo "selected='selected'";} ?>>Neurosciences</option>
<option value="436" <?php if(@$SecondDiscipline == "436"){ echo "selected='selected'";} ?>>NLS (other)</option>
<option value="437" <?php if(@$SecondDiscipline == "437"){ echo "selected='selected'";} ?>>Nuclear Engineering</option>
<option value="438" <?php if(@$SecondDiscipline == "438"){ echo "selected='selected'";} ?>>Nuclear Medicine & Organ Imaging</option>
<option value="439" <?php if(@$SecondDiscipline == "439"){ echo "selected='selected'";} ?>>Nuclear physics</option>
<option value="440" <?php if(@$SecondDiscipline == "440"){ echo "selected='selected'";} ?>>Nuclear Technologies in Medicine and Biosciences</option>
<option value="441" <?php if(@$SecondDiscipline == "441"){ echo "selected='selected'";} ?>>Nursing Science</option>
<option value="442" <?php if(@$SecondDiscipline == "442"){ echo "selected='selected'";} ?>>Nutrition</option>
<option value="443" <?php if(@$SecondDiscipline == "443"){ echo "selected='selected'";} ?>>Nutrition </option>
<option value="444" <?php if(@$SecondDiscipline == "444"){ echo "selected='selected'";} ?>>Nutrition & Metabolism</option>
<option value="445" <?php if(@$SecondDiscipline == "445"){ echo "selected='selected'";} ?>>Nutrition and Pediatrics</option>
<option value="446" <?php if(@$SecondDiscipline == "446"){ echo "selected='selected'";} ?>>Obstetrics & Maternal Health</option>
<option value="447" <?php if(@$SecondDiscipline == "447"){ echo "selected='selected'";} ?>>Obstetrics and maternal health</option>
<option value="448" <?php if(@$SecondDiscipline == "448"){ echo "selected='selected'";} ?>>Occupational health</option>
<option value="449" <?php if(@$SecondDiscipline == "449"){ echo "selected='selected'";} ?>>Oceanography</option>
<option value="450" <?php if(@$SecondDiscipline == "450"){ echo "selected='selected'";} ?>>Oceanology</option>
<option value="451" <?php if(@$SecondDiscipline == "451"){ echo "selected='selected'";} ?>>Oncology</option>
<option value="452" <?php if(@$SecondDiscipline == "452"){ echo "selected='selected'";} ?>>Operations research</option>
<option value="453" <?php if(@$SecondDiscipline == "453"){ echo "selected='selected'";} ?>>Ophthalmology</option>
<option value="454" <?php if(@$SecondDiscipline == "454"){ echo "selected='selected'";} ?>>Optical Engineering</option>
<option value="455" <?php if(@$SecondDiscipline == "455"){ echo "selected='selected'";} ?>>Optics</option>
<option value="456" <?php if(@$SecondDiscipline == "456"){ echo "selected='selected'";} ?>>Organic Chemistry</option>
<option value="457" <?php if(@$SecondDiscipline == "457"){ echo "selected='selected'";} ?>>Organic Sciences</option>
<option value="458" <?php if(@$SecondDiscipline == "458"){ echo "selected='selected'";} ?>>Organismal Biology</option>
<option value="459" <?php if(@$SecondDiscipline == "459"){ echo "selected='selected'";} ?>>Orthopaedics</option>
<option value="460" <?php if(@$SecondDiscipline == "460"){ echo "selected='selected'";} ?>>Other</option>
<option value="461" <?php if(@$SecondDiscipline == "461"){ echo "selected='selected'";} ?>>Other information and computer technologies</option>
<option value="462" <?php if(@$SecondDiscipline == "462"){ echo "selected='selected'";} ?>>Otorhinolaryngology</option>
<option value="463" <?php if(@$SecondDiscipline == "463"){ echo "selected='selected'";} ?>>Paediatrics & Child Health</option>
<option value="464" <?php if(@$SecondDiscipline == "464"){ echo "selected='selected'";} ?>>Paediatrics and child health</option>
<option value="465" <?php if(@$SecondDiscipline == "465"){ echo "selected='selected'";} ?>>Painting</option>
<option value="466" <?php if(@$SecondDiscipline == "466"){ echo "selected='selected'";} ?>>Palaeontology</option>
<option value="467" <?php if(@$SecondDiscipline == "467"){ echo "selected='selected'";} ?>>Palaeosciences</option>
<option value="468" <?php if(@$SecondDiscipline == "468"){ echo "selected='selected'";} ?>>Paleoclimate</option>
<option value="469" <?php if(@$SecondDiscipline == "469"){ echo "selected='selected'";} ?>>Paleontology</option>
<option value="470" <?php if(@$SecondDiscipline == "470"){ echo "selected='selected'";} ?>>Paleontology and Paleobiology</option>
<option value="471" <?php if(@$SecondDiscipline == "471"){ echo "selected='selected'";} ?>>Parasitology</option>
<option value="472" <?php if(@$SecondDiscipline == "472"){ echo "selected='selected'";} ?>>Particle</option>
<option value="473" <?php if(@$SecondDiscipline == "473"){ echo "selected='selected'";} ?>>Particle & Plasma Physics</option>
<option value="474" <?php if(@$SecondDiscipline == "474"){ echo "selected='selected'";} ?>>Particle and plasma physics</option>
<option value="475" <?php if(@$SecondDiscipline == "475"){ echo "selected='selected'";} ?>>Patient-oriented research</option>
<option value="476" <?php if(@$SecondDiscipline == "476"){ echo "selected='selected'";} ?>>Pediatrics & Child Health</option>
<option value="477" <?php if(@$SecondDiscipline == "477"){ echo "selected='selected'";} ?>>Performing and Creative Arts</option>
<option value="478" <?php if(@$SecondDiscipline == "478"){ echo "selected='selected'";} ?>>Performing arts</option>
<option value="479" <?php if(@$SecondDiscipline == "479"){ echo "selected='selected'";} ?>>Petrology</option>
<option value="480" <?php if(@$SecondDiscipline == "480"){ echo "selected='selected'";} ?>>Pharmaceutical Science</option>
<option value="481" <?php if(@$SecondDiscipline == "481"){ echo "selected='selected'";} ?>>Pharmaceutical Sciences</option>
<option value="482" <?php if(@$SecondDiscipline == "482"){ echo "selected='selected'";} ?>>Pharmacology</option>
<option value="483" <?php if(@$SecondDiscipline == "483"){ echo "selected='selected'";} ?>>Pharmacology </option>
<option value="484" <?php if(@$SecondDiscipline == "484"){ echo "selected='selected'";} ?>>Pharmacology & Pharmaceutical Sciences</option>
<option value="485" <?php if(@$SecondDiscipline == "485"){ echo "selected='selected'";} ?>>Phenomenological Physics</option>
<option value="486" <?php if(@$SecondDiscipline == "486"){ echo "selected='selected'";} ?>>Philosophy</option>
<option value="487" <?php if(@$SecondDiscipline == "487"){ echo "selected='selected'";} ?>>Photography</option>
<option value="488" <?php if(@$SecondDiscipline == "488"){ echo "selected='selected'";} ?>>Photonic materials</option>
<option value="489" <?php if(@$SecondDiscipline == "489"){ echo "selected='selected'";} ?>>Physcial Geopraphy </option>
<option value="490" <?php if(@$SecondDiscipline == "490"){ echo "selected='selected'";} ?>>Physical and Dynamic Meteorology</option>
<option value="491" <?php if(@$SecondDiscipline == "491"){ echo "selected='selected'";} ?>>Physical Chemistry</option>
<option value="492" <?php if(@$SecondDiscipline == "492"){ echo "selected='selected'";} ?>>Physical Geography</option>
<option value="493" <?php if(@$SecondDiscipline == "493"){ echo "selected='selected'";} ?>>Physical Oceanography</option>
<option value="494" <?php if(@$SecondDiscipline == "494"){ echo "selected='selected'";} ?>>Physical Sciences</option>
<option value="495" <?php if(@$SecondDiscipline == "495"){ echo "selected='selected'";} ?>>Physics</option>
<option value="496" <?php if(@$SecondDiscipline == "496"){ echo "selected='selected'";} ?>>Physics </option>
<option value="497" <?php if(@$SecondDiscipline == "497"){ echo "selected='selected'";} ?>>Physics (other)</option>
<option value="498" <?php if(@$SecondDiscipline == "498"){ echo "selected='selected'";} ?>>Physics of Living Systems</option>
<option value="499" <?php if(@$SecondDiscipline == "499"){ echo "selected='selected'";} ?>>Physiology</option>
<option value="500" <?php if(@$SecondDiscipline == "500"){ echo "selected='selected'";} ?>>Physiology Polymer Sciences</option>
<option value="501" <?php if(@$SecondDiscipline == "501"){ echo "selected='selected'";} ?>>Phyto-chemistry</option>
<option value="502" <?php if(@$SecondDiscipline == "502"){ echo "selected='selected'";} ?>>Plant Biotechnology</option>
<option value="503" <?php if(@$SecondDiscipline == "503"){ echo "selected='selected'";} ?>>Plant Pathology</option>
<option value="504" <?php if(@$SecondDiscipline == "504"){ echo "selected='selected'";} ?>>Plant Production</option>
<option value="505" <?php if(@$SecondDiscipline == "505"){ echo "selected='selected'";} ?>>Plant Sciences</option>
<option value="506" <?php if(@$SecondDiscipline == "506"){ echo "selected='selected'";} ?>>Plasma</option>
<option value="507" <?php if(@$SecondDiscipline == "507"){ echo "selected='selected'";} ?>>Podiatry</option>
<option value="508" <?php if(@$SecondDiscipline == "508"){ echo "selected='selected'";} ?>>Polar Science</option>
<option value="509" <?php if(@$SecondDiscipline == "509"){ echo "selected='selected'";} ?>>Policy Studies</option>
<option value="510" <?php if(@$SecondDiscipline == "510"){ echo "selected='selected'";} ?>>Political Sciences</option>
<option value="511" <?php if(@$SecondDiscipline == "511"){ echo "selected='selected'";} ?>>Political Sciences </option>
<option value="512" <?php if(@$SecondDiscipline == "512"){ echo "selected='selected'";} ?>>Political Sciences & Public Policy</option>
<option value="513" <?php if(@$SecondDiscipline == "513"){ echo "selected='selected'";} ?>>Political Studies</option>
<option value="514" <?php if(@$SecondDiscipline == "514"){ echo "selected='selected'";} ?>>Polymer Science</option>
<option value="515" <?php if(@$SecondDiscipline == "515"){ echo "selected='selected'";} ?>>Polymer Sciences</option>
<option value="516" <?php if(@$SecondDiscipline == "516"){ echo "selected='selected'";} ?>>Polymers</option>
<option value="517" <?php if(@$SecondDiscipline == "517"){ echo "selected='selected'";} ?>>Power Systems Development</option>
<option value="518" <?php if(@$SecondDiscipline == "518"){ echo "selected='selected'";} ?>>Private law</option>
<option value="519" <?php if(@$SecondDiscipline == "519"){ echo "selected='selected'";} ?>>Probability</option>
<option value="520" <?php if(@$SecondDiscipline == "520"){ echo "selected='selected'";} ?>>Process Engineering</option>
<option value="521" <?php if(@$SecondDiscipline == "521"){ echo "selected='selected'";} ?>>Process Manufacturing</option>
<option value="522" <?php if(@$SecondDiscipline == "522"){ echo "selected='selected'";} ?>>Proteomics</option>
<option value="523" <?php if(@$SecondDiscipline == "523"){ echo "selected='selected'";} ?>>Psychiatry</option>
<option value="524" <?php if(@$SecondDiscipline == "524"){ echo "selected='selected'";} ?>>Psychology</option>
<option value="525" <?php if(@$SecondDiscipline == "525"){ echo "selected='selected'";} ?>>Public Administration</option>
<option value="526" <?php if(@$SecondDiscipline == "526"){ echo "selected='selected'";} ?>>Public and Science Policy   </option>
<option value="527" <?php if(@$SecondDiscipline == "527"){ echo "selected='selected'";} ?>>Public Health</option>
<option value="528" <?php if(@$SecondDiscipline == "528"){ echo "selected='selected'";} ?>>Public law</option>
<option value="529" <?php if(@$SecondDiscipline == "529"){ echo "selected='selected'";} ?>>Public Management & Administration</option>
<option value="530" <?php if(@$SecondDiscipline == "530"){ echo "selected='selected'";} ?>>Public management and administration</option>
<option value="531" <?php if(@$SecondDiscipline == "531"){ echo "selected='selected'";} ?>>Public Relations</option>
<option value="532" <?php if(@$SecondDiscipline == "532"){ echo "selected='selected'";} ?>>Quality Management</option>
<option value="533" <?php if(@$SecondDiscipline == "533"){ echo "selected='selected'";} ?>>Quantity surveying</option>
<option value="534" <?php if(@$SecondDiscipline == "534"){ echo "selected='selected'";} ?>>R & D Psychology</option>
<option value="535" <?php if(@$SecondDiscipline == "535"){ echo "selected='selected'";} ?>>R & D Sociology</option>
<option value="536" <?php if(@$SecondDiscipline == "536"){ echo "selected='selected'";} ?>>R&D Psychology</option>
<option value="537" <?php if(@$SecondDiscipline == "537"){ echo "selected='selected'";} ?>>Rehabilitation Medicine</option>
<option value="538" <?php if(@$SecondDiscipline == "538"){ echo "selected='selected'";} ?>>Religion</option>
<option value="539" <?php if(@$SecondDiscipline == "539"){ echo "selected='selected'";} ?>>Religious legal systems</option>
<option value="540" <?php if(@$SecondDiscipline == "540"){ echo "selected='selected'";} ?>>Religious studies</option>
<option value="541" <?php if(@$SecondDiscipline == "541"){ echo "selected='selected'";} ?>>Remote Sensing</option>
<option value="542" <?php if(@$SecondDiscipline == "542"){ echo "selected='selected'";} ?>>Renewable Energy</option>
<option value="543" <?php if(@$SecondDiscipline == "543"){ echo "selected='selected'";} ?>>Research Management</option>
<option value="544" <?php if(@$SecondDiscipline == "544"){ echo "selected='selected'";} ?>>Research Management with Mathematics</option>
<option value="545" <?php if(@$SecondDiscipline == "545"){ echo "selected='selected'";} ?>>Research Management, Research Support & Administration</option>
<option value="546" <?php if(@$SecondDiscipline == "546"){ echo "selected='selected'";} ?>>Respiratory diseases</option>
<option value="547" <?php if(@$SecondDiscipline == "547"){ echo "selected='selected'";} ?>>Rheumatology</option>
<option value="548" <?php if(@$SecondDiscipline == "548"){ echo "selected='selected'";} ?>>Robotics and Computer Vision</option>
<option value="549" <?php if(@$SecondDiscipline == "549"){ echo "selected='selected'";} ?>>Rural Development</option>
<option value="550" <?php if(@$SecondDiscipline == "550"){ echo "selected='selected'";} ?>>Science & Statistics</option>
<option value="551" <?php if(@$SecondDiscipline == "551"){ echo "selected='selected'";} ?>>Science & Technologies</option>
<option value="552" <?php if(@$SecondDiscipline == "552"){ echo "selected='selected'";} ?>>Science & Technology</option>
<option value="553" <?php if(@$SecondDiscipline == "553"){ echo "selected='selected'";} ?>>Science and state</option>
<option value="554" <?php if(@$SecondDiscipline == "554"){ echo "selected='selected'";} ?>>Science Education</option>
<option value="555" <?php if(@$SecondDiscipline == "555"){ echo "selected='selected'";} ?>>Science Education </option>
<option value="556" <?php if(@$SecondDiscipline == "556"){ echo "selected='selected'";} ?>>Science Journalism</option>
<option value="557" <?php if(@$SecondDiscipline == "557"){ echo "selected='selected'";} ?>>Sculpture</option>
<option value="558" <?php if(@$SecondDiscipline == "558"){ echo "selected='selected'";} ?>>Sedimentary Geology</option>
<option value="559" <?php if(@$SecondDiscipline == "559"){ echo "selected='selected'";} ?>>Social & Economic Geography</option>
<option value="560" <?php if(@$SecondDiscipline == "560"){ echo "selected='selected'";} ?>>Social Science</option>
<option value="561" <?php if(@$SecondDiscipline == "561"){ echo "selected='selected'";} ?>>Social Science and Humanities</option>
<option value="562" <?php if(@$SecondDiscipline == "562"){ echo "selected='selected'";} ?>>Social Sciences</option>
<option value="563" <?php if(@$SecondDiscipline == "563"){ echo "selected='selected'";} ?>>Social Sciences and Humanities</option>
<option value="564" <?php if(@$SecondDiscipline == "564"){ echo "selected='selected'";} ?>>Social work</option>
<option value="565" <?php if(@$SecondDiscipline == "565"){ echo "selected='selected'";} ?>>Social Work </option>
<option value="566" <?php if(@$SecondDiscipline == "566"){ echo "selected='selected'";} ?>>Sociology</option>
<option value="567" <?php if(@$SecondDiscipline == "567"){ echo "selected='selected'";} ?>>Software Engineering</option>
<option value="568" <?php if(@$SecondDiscipline == "568"){ echo "selected='selected'";} ?>>Soil & Water  Sciences</option>
<option value="569" <?php if(@$SecondDiscipline == "569"){ echo "selected='selected'";} ?>>Soil & Water Sciences</option>
<option value="570" <?php if(@$SecondDiscipline == "570"){ echo "selected='selected'";} ?>>Solar Physics</option>
<option value="571" <?php if(@$SecondDiscipline == "571"){ echo "selected='selected'";} ?>>Solid State</option>
<option value="572" <?php if(@$SecondDiscipline == "572"){ echo "selected='selected'";} ?>>Space & Earth Science</option>
<option value="573" <?php if(@$SecondDiscipline == "573"){ echo "selected='selected'";} ?>>Space and earth science</option>
<option value="574" <?php if(@$SecondDiscipline == "574"){ echo "selected='selected'";} ?>>Space Science</option>
<option value="575" <?php if(@$SecondDiscipline == "575"){ echo "selected='selected'";} ?>>Space Sciences</option>
<option value="576" <?php if(@$SecondDiscipline == "576"){ echo "selected='selected'";} ?>>Sport Sciences</option>
<option value="577" <?php if(@$SecondDiscipline == "577"){ echo "selected='selected'";} ?>>Sports & Recreational Arts</option>
<option value="578" <?php if(@$SecondDiscipline == "578"){ echo "selected='selected'";} ?>>Sports & Recreational Arts </option>
<option value="579" <?php if(@$SecondDiscipline == "579"){ echo "selected='selected'";} ?>>Sports Medicine</option>
<option value="580" <?php if(@$SecondDiscipline == "580"){ echo "selected='selected'";} ?>>Sports Sciences</option>
<option value="581" <?php if(@$SecondDiscipline == "581"){ echo "selected='selected'";} ?>>SSH (other)</option>
<option value="582" <?php if(@$SecondDiscipline == "582"){ echo "selected='selected'";} ?>>Statistics</option>
<option value="583" <?php if(@$SecondDiscipline == "583"){ echo "selected='selected'";} ?>>Statistics & Probability</option>
<option value="584" <?php if(@$SecondDiscipline == "584"){ echo "selected='selected'";} ?>>Stem cell and regenerative biology</option>
<option value="585" <?php if(@$SecondDiscipline == "585"){ echo "selected='selected'";} ?>>STEM Education and Learning Research (other)</option>
<option value="586" <?php if(@$SecondDiscipline == "586"){ echo "selected='selected'";} ?>>Strategy</option>
<option value="587" <?php if(@$SecondDiscipline == "587"){ echo "selected='selected'";} ?>>Structural Biology</option>
<option value="588" <?php if(@$SecondDiscipline == "588"){ echo "selected='selected'";} ?>>Surgery</option>
<option value="589" <?php if(@$SecondDiscipline == "589"){ echo "selected='selected'";} ?>>Sustainable Agriculture </option>
<option value="590" <?php if(@$SecondDiscipline == "590"){ echo "selected='selected'";} ?>>Sustainable Chemistry</option>
<option value="591" <?php if(@$SecondDiscipline == "591"){ echo "selected='selected'";} ?>>Sustainable Development</option>
<option value="592" <?php if(@$SecondDiscipline == "592"){ echo "selected='selected'";} ?>>Systematics and Biodiversity</option>
<option value="593" <?php if(@$SecondDiscipline == "593"){ echo "selected='selected'";} ?>>Systems and Molecular Biology</option>
<option value="594" <?php if(@$SecondDiscipline == "594"){ echo "selected='selected'";} ?>>Systems Engineering</option>
<option value="595" <?php if(@$SecondDiscipline == "595"){ echo "selected='selected'";} ?>>Tax law</option>
<option value="596" <?php if(@$SecondDiscipline == "596"){ echo "selected='selected'";} ?>>Taxonomy</option>
<option value="597" <?php if(@$SecondDiscipline == "597"){ echo "selected='selected'";} ?>>Technologies & Applied Sciences</option>
<option value="598" <?php if(@$SecondDiscipline == "598"){ echo "selected='selected'";} ?>>Technologies and applied sciences</option>
<option value="599" <?php if(@$SecondDiscipline == "599"){ echo "selected='selected'";} ?>>Technology Education</option>
<option value="600" <?php if(@$SecondDiscipline == "600"){ echo "selected='selected'";} ?>>Tectonics</option>
<option value="601" <?php if(@$SecondDiscipline == "601"){ echo "selected='selected'";} ?>>Theatre</option>
<option value="602" <?php if(@$SecondDiscipline == "602"){ echo "selected='selected'";} ?>>Theology</option>
<option value="603" <?php if(@$SecondDiscipline == "603"){ echo "selected='selected'";} ?>>Theology and Religion</option>
<option value="604" <?php if(@$SecondDiscipline == "604"){ echo "selected='selected'";} ?>>Theoretical & Condensed Matter Physics</option>
<option value="605" <?php if(@$SecondDiscipline == "605"){ echo "selected='selected'";} ?>>Theoretical Physics</option>
<option value="606" <?php if(@$SecondDiscipline == "606"){ echo "selected='selected'";} ?>>Topology</option>
<option value="607" <?php if(@$SecondDiscipline == "607"){ echo "selected='selected'";} ?>>Tourism</option>
<option value="608" <?php if(@$SecondDiscipline == "608"){ echo "selected='selected'";} ?>>Town & Regional Planning</option>
<option value="609" <?php if(@$SecondDiscipline == "609"){ echo "selected='selected'";} ?>>Toxicology</option>
<option value="610" <?php if(@$SecondDiscipline == "610"){ echo "selected='selected'";} ?>>Trade and commerce</option>
<option value="611" <?php if(@$SecondDiscipline == "611"){ echo "selected='selected'";} ?>>Transportation Studies</option>
<option value="612" <?php if(@$SecondDiscipline == "612"){ echo "selected='selected'";} ?>>Trauma</option>
<option value="613" <?php if(@$SecondDiscipline == "613"){ echo "selected='selected'";} ?>>Urban and Regional Planning</option>
<option value="614" <?php if(@$SecondDiscipline == "614"){ echo "selected='selected'";} ?>>Veterinary Microbiology</option>
<option value="615" <?php if(@$SecondDiscipline == "615"){ echo "selected='selected'";} ?>>Veterinary Nursing</option>
<option value="616" <?php if(@$SecondDiscipline == "616"){ echo "selected='selected'";} ?>>Veterinary Science</option>
<option value="617" <?php if(@$SecondDiscipline == "617"){ echo "selected='selected'";} ?>>Veterinary Sciences</option>
<option value="618" <?php if(@$SecondDiscipline == "618"){ echo "selected='selected'";} ?>>Virology</option>
<option value="622" <?php if(@$SecondDiscipline == "622"){ echo "selected='selected'";} ?>>Waste and Circular Economy</option>
<option value="619" <?php if(@$SecondDiscipline == "619"){ echo "selected='selected'";} ?>>Waves</option>
<option value="620" <?php if(@$SecondDiscipline == "620"){ echo "selected='selected'";} ?>>Wood Science </option>
<option value="621" <?php if(@$SecondDiscipline == "621"){ echo "selected='selected'";} ?>>Zoology</option>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												<h5 class="divider divider-left">
                                        <div class="divider-text">Option 3:</div>
                                    </h5>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="ThirdProvince">Province</label>
                                                        <fieldset class="form-group">
                                                    <select class="choices form-select" id="ThirdProvince" name="ThirdProvince">
                                                        <option></option>
                                                        <option value="1" <?php if(@$ThirdProvince == "1"){ echo "selected='selected'";} ?>>Gauteng</option>
<option value="2" <?php if(@$ThirdProvince == "2"){ echo "selected='selected'";} ?>>Free State</option>
<option value="3" <?php if(@$ThirdProvince == "3"){ echo "selected='selected'";} ?>>Eastern Cape</option>
<option value="4" <?php if(@$ThirdProvince == "4"){ echo "selected='selected'";} ?>>KwaZulu-Natal</option>
<option value="5" <?php if(@$ThirdProvince == "5"){ echo "selected='selected'";} ?>>Limpopo</option>
<option value="6" <?php if(@$ThirdProvince == "6"){ echo "selected='selected'";} ?>>Mpumalanga</option>
<option value="7" <?php if(@$ThirdProvince == "7"){ echo "selected='selected'";} ?>>Northern Cape</option>
<option value="8" <?php if(@$ThirdProvince == "8"){ echo "selected='selected'";} ?>>North West</option>
<option value="9" <?php if(@$ThirdProvince == "9"){ echo "selected='selected'";} ?>>Western Cape</option>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="ThirdDiscipline">Discipline/Area of Specialisation</label>
                                                        <fieldset class="form-group">
                                                    <select class="choices form-select" id="ThirdDiscipline" name="ThirdDiscipline">
                                                        <option></option>
                                                        <option value="27" <?php if(@$ThirdDiscipline == "27"){ echo "selected='selected'";} ?>>Accounting</option>
<option value="28" <?php if(@$ThirdDiscipline == "28"){ echo "selected='selected'";} ?>>Accounting and finance</option>
<option value="29" <?php if(@$ThirdDiscipline == "29"){ echo "selected='selected'";} ?>>Accounting science</option>
<option value="30" <?php if(@$ThirdDiscipline == "30"){ echo "selected='selected'";} ?>>Actuarial Science</option>
<option value="31" <?php if(@$ThirdDiscipline == "31"){ echo "selected='selected'";} ?>>Acturial science</option>
<option value="32" <?php if(@$ThirdDiscipline == "32"){ echo "selected='selected'";} ?>>additive manufacturing</option>
<option value="33" <?php if(@$ThirdDiscipline == "33"){ echo "selected='selected'";} ?>>Administration</option>
<option value="34" <?php if(@$ThirdDiscipline == "34"){ echo "selected='selected'";} ?>>Aeronautical and Aerospace</option>
<option value="35" <?php if(@$ThirdDiscipline == "35"){ echo "selected='selected'";} ?>>Aeronomy</option>
<option value="36" <?php if(@$ThirdDiscipline == "36"){ echo "selected='selected'";} ?>>Aerospace & Aeronautical Engineering</option>
<option value="37" <?php if(@$ThirdDiscipline == "37"){ echo "selected='selected'";} ?>>African Languages</option>
<option value="38" <?php if(@$ThirdDiscipline == "38"){ echo "selected='selected'";} ?>>AGRI (other)</option>
<option value="39" <?php if(@$ThirdDiscipline == "39"){ echo "selected='selected'";} ?>>Agribusiness</option>
<option value="40" <?php if(@$ThirdDiscipline == "40"){ echo "selected='selected'";} ?>>Agricultural Biotechnology</option>
<option value="41" <?php if(@$ThirdDiscipline == "41"){ echo "selected='selected'";} ?>>Agricultural Economics</option>
<option value="42" <?php if(@$ThirdDiscipline == "42"){ echo "selected='selected'";} ?>>Agricultural Engineering</option>
<option value="43" <?php if(@$ThirdDiscipline == "43"){ echo "selected='selected'";} ?>>Agricultural Extension</option>
<option value="44" <?php if(@$ThirdDiscipline == "44"){ echo "selected='selected'";} ?>>Agricultural Management</option>
<option value="45" <?php if(@$ThirdDiscipline == "45"){ echo "selected='selected'";} ?>>Agricultural Resource Management</option>
<option value="46" <?php if(@$ThirdDiscipline == "46"){ echo "selected='selected'";} ?>>Agricultural Sciences</option>
<option value="47" <?php if(@$ThirdDiscipline == "47"){ echo "selected='selected'";} ?>>Agriculture</option>
<option value="48" <?php if(@$ThirdDiscipline == "48"){ echo "selected='selected'";} ?>>Agriculture Economics</option>
<option value="49" <?php if(@$ThirdDiscipline == "49"){ echo "selected='selected'";} ?>>Agriculture Education </option>
<option value="50" <?php if(@$ThirdDiscipline == "50"){ echo "selected='selected'";} ?>>Agrometeorology</option>
<option value="51" <?php if(@$ThirdDiscipline == "51"){ echo "selected='selected'";} ?>>Agrometereology</option>
<option value="52" <?php if(@$ThirdDiscipline == "52"){ echo "selected='selected'";} ?>>Agroprocessing</option>
<option value="53" <?php if(@$ThirdDiscipline == "53"){ echo "selected='selected'";} ?>>Algebra, Number Theory, and Combinatorics</option>
<option value="54" <?php if(@$ThirdDiscipline == "54"){ echo "selected='selected'";} ?>>Algorithms and Theoretical Foundations</option>
<option value="55" <?php if(@$ThirdDiscipline == "55"){ echo "selected='selected'";} ?>>Anaesthesia & Pain Management</option>
<option value="56" <?php if(@$ThirdDiscipline == "56"){ echo "selected='selected'";} ?>>Anaesthesia and pain management</option>
<option value="57" <?php if(@$ThirdDiscipline == "57"){ echo "selected='selected'";} ?>>Analysis</option>
<option value="58" <?php if(@$ThirdDiscipline == "58"){ echo "selected='selected'";} ?>>Analytical Chemistry</option>
<option value="59" <?php if(@$ThirdDiscipline == "59"){ echo "selected='selected'";} ?>>Anatomical pathology</option>
<option value="60" <?php if(@$ThirdDiscipline == "60"){ echo "selected='selected'";} ?>>Anatomical Sciences</option>
<option value="61" <?php if(@$ThirdDiscipline == "61"){ echo "selected='selected'";} ?>>Animal and Veterinary Sciences</option>
<option value="62" <?php if(@$ThirdDiscipline == "62"){ echo "selected='selected'";} ?>>Animal Breeding & Genetics</option>
<option value="63" <?php if(@$ThirdDiscipline == "63"){ echo "selected='selected'";} ?>>Animal Diseases</option>
<option value="64" <?php if(@$ThirdDiscipline == "64"){ echo "selected='selected'";} ?>>Animal parasitology</option>
<option value="65" <?php if(@$ThirdDiscipline == "65"){ echo "selected='selected'";} ?>>Animal Production</option>
<option value="66" <?php if(@$ThirdDiscipline == "66"){ echo "selected='selected'";} ?>>Animal Science</option>
<option value="67" <?php if(@$ThirdDiscipline == "67"){ echo "selected='selected'";} ?>>Anthropology</option>
<option value="68" <?php if(@$ThirdDiscipline == "68"){ echo "selected='selected'";} ?>>Applied Mathematics</option>
<option value="69" <?php if(@$ThirdDiscipline == "69"){ echo "selected='selected'";} ?>>Archaeology</option>
<option value="70" <?php if(@$ThirdDiscipline == "70"){ echo "selected='selected'";} ?>>Architecture</option>
<option value="71" <?php if(@$ThirdDiscipline == "71"){ echo "selected='selected'";} ?>>Argriculture </option>
<option value="72" <?php if(@$ThirdDiscipline == "72"){ echo "selected='selected'";} ?>>Argrometereology</option>
<option value="73" <?php if(@$ThirdDiscipline == "73"){ echo "selected='selected'";} ?>>Artifical Intelligence</option>
<option value="74" <?php if(@$ThirdDiscipline == "74"){ echo "selected='selected'";} ?>>Artificial intelligence</option>
<option value="75" <?php if(@$ThirdDiscipline == "75"){ echo "selected='selected'";} ?>>Arts</option>
<option value="76" <?php if(@$ThirdDiscipline == "76"){ echo "selected='selected'";} ?>>Astronomy</option>
<option value="77" <?php if(@$ThirdDiscipline == "77"){ echo "selected='selected'";} ?>>Astrophysics</option>
<option value="78" <?php if(@$ThirdDiscipline == "78"){ echo "selected='selected'";} ?>>Atmospheric Chemistry</option>
<option value="79" <?php if(@$ThirdDiscipline == "79"){ echo "selected='selected'";} ?>>Atmospheric Science & Meteorology</option>
<option value="80" <?php if(@$ThirdDiscipline == "80"){ echo "selected='selected'";} ?>>Atomic and Molecular</option>
<option value="81" <?php if(@$ThirdDiscipline == "81"){ echo "selected='selected'";} ?>>Atomic, Molecular & Nuclear Physics</option>
<option value="82" <?php if(@$ThirdDiscipline == "82"){ echo "selected='selected'";} ?>>Atomic, Molecular, Nuclear Physics</option>
<option value="83" <?php if(@$ThirdDiscipline == "83"){ echo "selected='selected'";} ?>>Auditing</option>
<option value="84" <?php if(@$ThirdDiscipline == "84"){ echo "selected='selected'";} ?>>Automotive Engineering</option>
<option value="85" <?php if(@$ThirdDiscipline == "85"){ echo "selected='selected'";} ?>>Basic and Applied Microbiology</option>
<option value="86" <?php if(@$ThirdDiscipline == "86"){ echo "selected='selected'";} ?>>Basic Medical Science</option>
<option value="87" <?php if(@$ThirdDiscipline == "87"){ echo "selected='selected'";} ?>>Biochemistry</option>
<option value="88" <?php if(@$ThirdDiscipline == "88"){ echo "selected='selected'";} ?>>Bioengineering</option>
<option value="89" <?php if(@$ThirdDiscipline == "89"){ echo "selected='selected'";} ?>>Bio-engineering</option>
<option value="90" <?php if(@$ThirdDiscipline == "90"){ echo "selected='selected'";} ?>>Biogeochemistry</option>
<option value="91" <?php if(@$ThirdDiscipline == "91"){ echo "selected='selected'";} ?>>Bioinformatics</option>
<option value="92" <?php if(@$ThirdDiscipline == "92"){ echo "selected='selected'";} ?>>Bioinformatics and Computational Biology</option>
<option value="93" <?php if(@$ThirdDiscipline == "93"){ echo "selected='selected'";} ?>>Bioinformatics and other Informatics</option>
<option value="94" <?php if(@$ThirdDiscipline == "94"){ echo "selected='selected'";} ?>>Biological Oceanography</option>
<option value="95" <?php if(@$ThirdDiscipline == "95"){ echo "selected='selected'";} ?>>Biological science</option>
<option value="96" <?php if(@$ThirdDiscipline == "96"){ echo "selected='selected'";} ?>>Biological Sciences</option>
<option value="97" <?php if(@$ThirdDiscipline == "97"){ echo "selected='selected'";} ?>>Biology</option>
<option value="98" <?php if(@$ThirdDiscipline == "98"){ echo "selected='selected'";} ?>>Biomaterials</option>
<option value="99" <?php if(@$ThirdDiscipline == "99"){ echo "selected='selected'";} ?>>Biomedical Technology</option>
<option value="100" <?php if(@$ThirdDiscipline == "100"){ echo "selected='selected'";} ?>>Biometrics</option>
<option value="101" <?php if(@$ThirdDiscipline == "101"){ echo "selected='selected'";} ?>>Biophysics</option>
<option value="102" <?php if(@$ThirdDiscipline == "102"){ echo "selected='selected'";} ?>>Bioprocesses</option>
<option value="103" <?php if(@$ThirdDiscipline == "103"){ echo "selected='selected'";} ?>>Biostatistics</option>
<option value="104" <?php if(@$ThirdDiscipline == "104"){ echo "selected='selected'";} ?>>Biotechnology</option>
<option value="105" <?php if(@$ThirdDiscipline == "105"){ echo "selected='selected'";} ?>>Botany</option>
<option value="106" <?php if(@$ThirdDiscipline == "106"){ echo "selected='selected'";} ?>>Business administration</option>
<option value="107" <?php if(@$ThirdDiscipline == "107"){ echo "selected='selected'";} ?>>Business economics</option>
<option value="108" <?php if(@$ThirdDiscipline == "108"){ echo "selected='selected'";} ?>>Business Sciences </option>
<option value="109" <?php if(@$ThirdDiscipline == "109"){ echo "selected='selected'";} ?>>Capital Markets and Investments</option>
<option value="110" <?php if(@$ThirdDiscipline == "110"){ echo "selected='selected'";} ?>>Cardiology</option>
<option value="111" <?php if(@$ThirdDiscipline == "111"){ echo "selected='selected'";} ?>>Cardiovascular diseases</option>
<option value="112" <?php if(@$ThirdDiscipline == "112"){ echo "selected='selected'";} ?>>Cell Biology</option>
<option value="113" <?php if(@$ThirdDiscipline == "113"){ echo "selected='selected'";} ?>>Cellular and Molecular Biology</option>
<option value="114" <?php if(@$ThirdDiscipline == "114"){ echo "selected='selected'";} ?>>Ceramics</option>
<option value="115" <?php if(@$ThirdDiscipline == "115"){ echo "selected='selected'";} ?>>Chemical Catalysis</option>
<option value="116" <?php if(@$ThirdDiscipline == "116"){ echo "selected='selected'";} ?>>Chemical Engineering</option>
<option value="117" <?php if(@$ThirdDiscipline == "117"){ echo "selected='selected'";} ?>>Chemical Measurement and Imaging</option>
<option value="118" <?php if(@$ThirdDiscipline == "118"){ echo "selected='selected'";} ?>>Chemical Oceanography</option>
<option value="119" <?php if(@$ThirdDiscipline == "119"){ echo "selected='selected'";} ?>>Chemical Pathology</option>
<option value="120" <?php if(@$ThirdDiscipline == "120"){ echo "selected='selected'";} ?>>Chemical Sciences</option>
<option value="121" <?php if(@$ThirdDiscipline == "121"){ echo "selected='selected'";} ?>>Chemical Structure, Dynamics, and Mechanism</option>
<option value="122" <?php if(@$ThirdDiscipline == "122"){ echo "selected='selected'";} ?>>Chemical Synthesis</option>
<option value="123" <?php if(@$ThirdDiscipline == "123"){ echo "selected='selected'";} ?>>Chemical Theory, Models and Computational Methods</option>
<option value="124" <?php if(@$ThirdDiscipline == "124"){ echo "selected='selected'";} ?>>Chemistry</option>
<option value="125" <?php if(@$ThirdDiscipline == "125"){ echo "selected='selected'";} ?>>Chemistry of Life Processes</option>
<option value="126" <?php if(@$ThirdDiscipline == "126"){ echo "selected='selected'";} ?>>Chemistry of materials</option>
<option value="127" <?php if(@$ThirdDiscipline == "127"){ echo "selected='selected'";} ?>>Chemistry Sciences Engineering</option>
<option value="128" <?php if(@$ThirdDiscipline == "128"){ echo "selected='selected'";} ?>>Circuits</option>
<option value="129" <?php if(@$ThirdDiscipline == "129"){ echo "selected='selected'";} ?>>Civil Engineering</option>
<option value="130" <?php if(@$ThirdDiscipline == "130"){ echo "selected='selected'";} ?>>Civil procedure and courts</option>
<option value="131" <?php if(@$ThirdDiscipline == "131"){ echo "selected='selected'";} ?>>Classics</option>
<option value="132" <?php if(@$ThirdDiscipline == "132"){ echo "selected='selected'";} ?>>Climate and Large-Scale Atmospheric Dynamics</option>
<option value="133" <?php if(@$ThirdDiscipline == "133"){ echo "selected='selected'";} ?>>Climate Change</option>
<option value="134" <?php if(@$ThirdDiscipline == "134"){ echo "selected='selected'";} ?>>Clinical medicine</option>
<option value="135" <?php if(@$ThirdDiscipline == "135"){ echo "selected='selected'";} ?>>Collections Management</option>
<option value="136" <?php if(@$ThirdDiscipline == "136"){ echo "selected='selected'";} ?>>Commercial Law</option>
<option value="137" <?php if(@$ThirdDiscipline == "137"){ echo "selected='selected'";} ?>>Communication</option>
<option value="138" <?php if(@$ThirdDiscipline == "138"){ echo "selected='selected'";} ?>>Communication & Media Studies</option>
<option value="139" <?php if(@$ThirdDiscipline == "139"){ echo "selected='selected'";} ?>>Communication and Information Theory</option>
<option value="140" <?php if(@$ThirdDiscipline == "140"){ echo "selected='selected'";} ?>>Communication Technology</option>
<option value="141" <?php if(@$ThirdDiscipline == "141"){ echo "selected='selected'";} ?>>Comparative Law</option>
<option value="142" <?php if(@$ThirdDiscipline == "142"){ echo "selected='selected'";} ?>>Computational and Data-enabled Science</option>
<option value="143" <?php if(@$ThirdDiscipline == "143"){ echo "selected='selected'";} ?>>Computational Mathematics</option>
<option value="144" <?php if(@$ThirdDiscipline == "144"){ echo "selected='selected'";} ?>>Computational Science and Engineering</option>
<option value="145" <?php if(@$ThirdDiscipline == "145"){ echo "selected='selected'";} ?>>Computational Statistics</option>
<option value="146" <?php if(@$ThirdDiscipline == "146"){ echo "selected='selected'";} ?>>Computer Architecture</option>
<option value="147" <?php if(@$ThirdDiscipline == "147"){ echo "selected='selected'";} ?>>Computer Engineering</option>
<option value="148" <?php if(@$ThirdDiscipline == "148"){ echo "selected='selected'";} ?>>Computer Hardware</option>
<option value="149" <?php if(@$ThirdDiscipline == "149"){ echo "selected='selected'";} ?>>Computer multimedia systems</option>
<option value="150" <?php if(@$ThirdDiscipline == "150"){ echo "selected='selected'";} ?>>Computer Networks</option>
<option value="151" <?php if(@$ThirdDiscipline == "151"){ echo "selected='selected'";} ?>>Computer Programming</option>
<option value="152" <?php if(@$ThirdDiscipline == "152"){ echo "selected='selected'";} ?>>Computer Science and Information Systems</option>
<option value="153" <?php if(@$ThirdDiscipline == "153"){ echo "selected='selected'";} ?>>Computer Security and Privacy</option>
<option value="154" <?php if(@$ThirdDiscipline == "154"){ echo "selected='selected'";} ?>>Computer Software</option>
<option value="155" <?php if(@$ThirdDiscipline == "155"){ echo "selected='selected'";} ?>>Computer Systems and Embedded Systems</option>
<option value="156" <?php if(@$ThirdDiscipline == "156"){ echo "selected='selected'";} ?>>Condensed Matter</option>
<option value="157" <?php if(@$ThirdDiscipline == "157"){ echo "selected='selected'";} ?>>Constitutional and administrative law</option>
<option value="158" <?php if(@$ThirdDiscipline == "158"){ echo "selected='selected'";} ?>>Construction & Building</option>
<option value="159" <?php if(@$ThirdDiscipline == "159"){ echo "selected='selected'";} ?>>Construction Industry & Building</option>
<option value="160" <?php if(@$ThirdDiscipline == "160"){ echo "selected='selected'";} ?>>Construction industry and building</option>
<option value="161" <?php if(@$ThirdDiscipline == "161"){ echo "selected='selected'";} ?>>Corporate governance</option>
<option value="162" <?php if(@$ThirdDiscipline == "162"){ echo "selected='selected'";} ?>>Creative Arts</option>
<option value="163" <?php if(@$ThirdDiscipline == "163"){ echo "selected='selected'";} ?>>Criminal law</option>
<option value="164" <?php if(@$ThirdDiscipline == "164"){ echo "selected='selected'";} ?>>Criminology</option>
<option value="165" <?php if(@$ThirdDiscipline == "165"){ echo "selected='selected'";} ?>>CRM (other)</option>
<option value="166" <?php if(@$ThirdDiscipline == "166"){ echo "selected='selected'";} ?>>Cultural studies</option>
<option value="167" <?php if(@$ThirdDiscipline == "167"){ echo "selected='selected'";} ?>>Customary law</option>
<option value="168" <?php if(@$ThirdDiscipline == "168"){ echo "selected='selected'";} ?>>Dairy Science</option>
<option value="169" <?php if(@$ThirdDiscipline == "169"){ echo "selected='selected'";} ?>>Data Mining and Information Retrieval</option>
<option value="170" <?php if(@$ThirdDiscipline == "170"){ echo "selected='selected'";} ?>>Databases</option>
<option value="171" <?php if(@$ThirdDiscipline == "171"){ echo "selected='selected'";} ?>>Decorative arts</option>
<option value="172" <?php if(@$ThirdDiscipline == "172"){ echo "selected='selected'";} ?>>Degenerative diseases</option>
<option value="173" <?php if(@$ThirdDiscipline == "173"){ echo "selected='selected'";} ?>>Demography</option>
<option value="174" <?php if(@$ThirdDiscipline == "174"){ echo "selected='selected'";} ?>>Dental Sciences</option>
<option value="175" <?php if(@$ThirdDiscipline == "175"){ echo "selected='selected'";} ?>>Dermatology</option>
<option value="176" <?php if(@$ThirdDiscipline == "176"){ echo "selected='selected'";} ?>>Design studies</option>
<option value="177" <?php if(@$ThirdDiscipline == "177"){ echo "selected='selected'";} ?>>Development Studies</option>
<option value="178" <?php if(@$ThirdDiscipline == "178"){ echo "selected='selected'";} ?>>Developmental Biology</option>
<option value="179" <?php if(@$ThirdDiscipline == "179"){ echo "selected='selected'";} ?>>Developmental Studies</option>
<option value="180" <?php if(@$ThirdDiscipline == "180"){ echo "selected='selected'";} ?>>Diabetology</option>
<option value="181" <?php if(@$ThirdDiscipline == "181"){ echo "selected='selected'";} ?>>Dietetics</option>
<option value="182" <?php if(@$ThirdDiscipline == "182"){ echo "selected='selected'";} ?>>Dietetics </option>
<option value="183" <?php if(@$ThirdDiscipline == "183"){ echo "selected='selected'";} ?>>Diffusion</option>
<option value="184" <?php if(@$ThirdDiscipline == "184"){ echo "selected='selected'";} ?>>Dramatic arts</option>
<option value="185" <?php if(@$ThirdDiscipline == "185"){ echo "selected='selected'";} ?>>Drug discovery</option>
<option value="186" <?php if(@$ThirdDiscipline == "186"){ echo "selected='selected'";} ?>>Drug Discovery and Development</option>
<option value="187" <?php if(@$ThirdDiscipline == "187"){ echo "selected='selected'";} ?>>Earth and Related Environmental sciences</option>
<option value="188" <?php if(@$ThirdDiscipline == "188"){ echo "selected='selected'";} ?>>Earth Observation</option>
<option value="189" <?php if(@$ThirdDiscipline == "189"){ echo "selected='selected'";} ?>>Earth Science</option>
<option value="190" <?php if(@$ThirdDiscipline == "190"){ echo "selected='selected'";} ?>>Earth Sciences</option>
<option value="191" <?php if(@$ThirdDiscipline == "191"){ echo "selected='selected'";} ?>>Ecology</option>
<option value="192" <?php if(@$ThirdDiscipline == "192"){ echo "selected='selected'";} ?>>Ecology & Env Science</option>
<option value="193" <?php if(@$ThirdDiscipline == "193"){ echo "selected='selected'";} ?>>Ecology & Enviromental Science</option>
<option value="194" <?php if(@$ThirdDiscipline == "194"){ echo "selected='selected'";} ?>>Ecology & Environmental Science</option>
<option value="195" <?php if(@$ThirdDiscipline == "195"){ echo "selected='selected'";} ?>>Ecology & Environmental Sciences</option>
<option value="196" <?php if(@$ThirdDiscipline == "196"){ echo "selected='selected'";} ?>>Economic Sciences</option>
<option value="197" <?php if(@$ThirdDiscipline == "197"){ echo "selected='selected'";} ?>>Economics</option>
<option value="198" <?php if(@$ThirdDiscipline == "198"){ echo "selected='selected'";} ?>>Education</option>
<option value="199" <?php if(@$ThirdDiscipline == "199"){ echo "selected='selected'";} ?>>Education </option>
<option value="200" <?php if(@$ThirdDiscipline == "200"){ echo "selected='selected'";} ?>>Elasticity</option>
<option value="201" <?php if(@$ThirdDiscipline == "201"){ echo "selected='selected'";} ?>>Electrical Engineering</option>
<option value="202" <?php if(@$ThirdDiscipline == "202"){ echo "selected='selected'";} ?>>Electromagnetism</option>
<option value="203" <?php if(@$ThirdDiscipline == "203"){ echo "selected='selected'";} ?>>Electronic Engineering</option>
<option value="204" <?php if(@$ThirdDiscipline == "204"){ echo "selected='selected'";} ?>>Electronic materials</option>
<option value="205" <?php if(@$ThirdDiscipline == "205"){ echo "selected='selected'";} ?>>Electronics Engineering</option>
<option value="206" <?php if(@$ThirdDiscipline == "206"){ echo "selected='selected'";} ?>>EMAS (other)</option>
<option value="207" <?php if(@$ThirdDiscipline == "207"){ echo "selected='selected'";} ?>>Embryology & Fetal Development</option>
<option value="208" <?php if(@$ThirdDiscipline == "208"){ echo "selected='selected'";} ?>>Endocrinology</option>
<option value="209" <?php if(@$ThirdDiscipline == "209"){ echo "selected='selected'";} ?>>Energy</option>
<option value="210" <?php if(@$ThirdDiscipline == "210"){ echo "selected='selected'";} ?>>Energy Efficiency</option>
<option value="211" <?php if(@$ThirdDiscipline == "211"){ echo "selected='selected'";} ?>>ENG (other)</option>
<option value="212" <?php if(@$ThirdDiscipline == "212"){ echo "selected='selected'";} ?>>Engineering</option>
<option value="213" <?php if(@$ThirdDiscipline == "213"){ echo "selected='selected'";} ?>>Engineering Education</option>
<option value="214" <?php if(@$ThirdDiscipline == "214"){ echo "selected='selected'";} ?>>Engineering Management</option>
<option value="215" <?php if(@$ThirdDiscipline == "215"){ echo "selected='selected'";} ?>>Engineering Sciences</option>
<option value="216" <?php if(@$ThirdDiscipline == "216"){ echo "selected='selected'";} ?>>Entomology</option>
<option value="217" <?php if(@$ThirdDiscipline == "217"){ echo "selected='selected'";} ?>>Enviromental Engineering</option>
<option value="218" <?php if(@$ThirdDiscipline == "218"){ echo "selected='selected'";} ?>>Enviromental Studies</option>
<option value="219" <?php if(@$ThirdDiscipline == "219"){ echo "selected='selected'";} ?>>Environment</option>
<option value="220" <?php if(@$ThirdDiscipline == "220"){ echo "selected='selected'";} ?>>Environment Sciences</option>
<option value="221" <?php if(@$ThirdDiscipline == "221"){ echo "selected='selected'";} ?>>Environmental and Earth Sciences</option>
<option value="222" <?php if(@$ThirdDiscipline == "222"){ echo "selected='selected'";} ?>>Environmental Biology</option>
<option value="223" <?php if(@$ThirdDiscipline == "223"){ echo "selected='selected'";} ?>>Environmental biotechnology</option>
<option value="224" <?php if(@$ThirdDiscipline == "224"){ echo "selected='selected'";} ?>>Environmental Chemical Systems</option>
<option value="225" <?php if(@$ThirdDiscipline == "225"){ echo "selected='selected'";} ?>>Environmental Engineering</option>
<option value="226" <?php if(@$ThirdDiscipline == "226"){ echo "selected='selected'";} ?>>Environmental Health</option>
<option value="227" <?php if(@$ThirdDiscipline == "227"){ echo "selected='selected'";} ?>>Environmental Health </option>
<option value="228" <?php if(@$ThirdDiscipline == "228"){ echo "selected='selected'";} ?>>Environmental Sciences</option>
<option value="229" <?php if(@$ThirdDiscipline == "229"){ echo "selected='selected'";} ?>>Environmental Studies</option>
<option value="230" <?php if(@$ThirdDiscipline == "230"){ echo "selected='selected'";} ?>>Epidemiology</option>
<option value="231" <?php if(@$ThirdDiscipline == "231"){ echo "selected='selected'";} ?>>Epidemiology </option>
<option value="232" <?php if(@$ThirdDiscipline == "232"){ echo "selected='selected'";} ?>>Epidemiology, incl. burden of disease</option>
<option value="233" <?php if(@$ThirdDiscipline == "233"){ echo "selected='selected'";} ?>>Ergonomics and Sports science</option>
<option value="234" <?php if(@$ThirdDiscipline == "234"){ echo "selected='selected'";} ?>>Ethics</option>
<option value="235" <?php if(@$ThirdDiscipline == "235"){ echo "selected='selected'";} ?>>Evolution and developmental biology</option>
<option value="236" <?php if(@$ThirdDiscipline == "236"){ echo "selected='selected'";} ?>>Evolutionary Biology</option>
<option value="237" <?php if(@$ThirdDiscipline == "237"){ echo "selected='selected'";} ?>>Financial Management</option>
<option value="238" <?php if(@$ThirdDiscipline == "238"){ echo "selected='selected'";} ?>>Fine arts</option>
<option value="239" <?php if(@$ThirdDiscipline == "239"){ echo "selected='selected'";} ?>>Fisheries</option>
<option value="240" <?php if(@$ThirdDiscipline == "240"){ echo "selected='selected'";} ?>>Fisheries </option>
<option value="241" <?php if(@$ThirdDiscipline == "241"){ echo "selected='selected'";} ?>>Fluids  </option>
<option value="242" <?php if(@$ThirdDiscipline == "242"){ echo "selected='selected'";} ?>>Food Science & Technology</option>
<option value="243" <?php if(@$ThirdDiscipline == "243"){ echo "selected='selected'";} ?>>Food Sciences & Technologies</option>
<option value="244" <?php if(@$ThirdDiscipline == "244"){ echo "selected='selected'";} ?>>Food Sciences & Technology</option>
<option value="245" <?php if(@$ThirdDiscipline == "245"){ echo "selected='selected'";} ?>>Food sciences and technology</option>
<option value="246" <?php if(@$ThirdDiscipline == "246"){ echo "selected='selected'";} ?>>Food Technology</option>
<option value="247" <?php if(@$ThirdDiscipline == "247"){ echo "selected='selected'";} ?>>Forensic Sciences</option>
<option value="248" <?php if(@$ThirdDiscipline == "248"){ echo "selected='selected'";} ?>>Forest Science</option>
<option value="249" <?php if(@$ThirdDiscipline == "249"){ echo "selected='selected'";} ?>>Forestry</option>
<option value="250" <?php if(@$ThirdDiscipline == "250"){ echo "selected='selected'";} ?>>Formal Methods, Verification, and Programming Languages</option>
<option value="251" <?php if(@$ThirdDiscipline == "251"){ echo "selected='selected'";} ?>>Fresh Water Biology</option>
<option value="252" <?php if(@$ThirdDiscipline == "252"){ echo "selected='selected'";} ?>>Fresh Water Biology & Limnology</option>
<option value="253" <?php if(@$ThirdDiscipline == "253"){ echo "selected='selected'";} ?>>Functional Genomics</option>
<option value="254" <?php if(@$ThirdDiscipline == "254"){ echo "selected='selected'";} ?>>Game Ranching & Farming</option>
<option value="255" <?php if(@$ThirdDiscipline == "255"){ echo "selected='selected'";} ?>>Game ranching and farming</option>
<option value="256" <?php if(@$ThirdDiscipline == "256"){ echo "selected='selected'";} ?>>Gastrointestinal diseases</option>
<option value="257" <?php if(@$ThirdDiscipline == "257"){ echo "selected='selected'";} ?>>General practice</option>
<option value="258" <?php if(@$ThirdDiscipline == "258"){ echo "selected='selected'";} ?>>Genetics</option>
<option value="259" <?php if(@$ThirdDiscipline == "259"){ echo "selected='selected'";} ?>>Genito-urinary diseases (incl. Urology)</option>
<option value="260" <?php if(@$ThirdDiscipline == "260"){ echo "selected='selected'";} ?>>Genomic biology</option>
<option value="261" <?php if(@$ThirdDiscipline == "261"){ echo "selected='selected'";} ?>>Genomics</option>
<option value="262" <?php if(@$ThirdDiscipline == "262"){ echo "selected='selected'";} ?>>Geobiology</option>
<option value="263" <?php if(@$ThirdDiscipline == "263"){ echo "selected='selected'";} ?>>Geochemistry</option>
<option value="264" <?php if(@$ThirdDiscipline == "264"){ echo "selected='selected'";} ?>>Geodynamics</option>
<option value="265" <?php if(@$ThirdDiscipline == "265"){ echo "selected='selected'";} ?>>Geographic Information Science</option>
<option value="266" <?php if(@$ThirdDiscipline == "266"){ echo "selected='selected'";} ?>>Geographic Information Systems</option>
<option value="267" <?php if(@$ThirdDiscipline == "267"){ echo "selected='selected'";} ?>>Geography</option>
<option value="268" <?php if(@$ThirdDiscipline == "268"){ echo "selected='selected'";} ?>>Geohydrology</option>
<option value="269" <?php if(@$ThirdDiscipline == "269"){ echo "selected='selected'";} ?>>Geology</option>
<option value="270" <?php if(@$ThirdDiscipline == "270"){ echo "selected='selected'";} ?>>Geometric Analysis</option>
<option value="271" <?php if(@$ThirdDiscipline == "271"){ echo "selected='selected'";} ?>>Geomorphology</option>
<option value="272" <?php if(@$ThirdDiscipline == "272"){ echo "selected='selected'";} ?>>Geophysics</option>
<option value="273" <?php if(@$ThirdDiscipline == "273"){ echo "selected='selected'";} ?>>Geosciences (other)</option>
<option value="274" <?php if(@$ThirdDiscipline == "274"){ echo "selected='selected'";} ?>>Geospace Physics</option>
<option value="275" <?php if(@$ThirdDiscipline == "275"){ echo "selected='selected'";} ?>>Geriatrics</option>
<option value="276" <?php if(@$ThirdDiscipline == "276"){ echo "selected='selected'";} ?>>Glaciology</option>
<option value="277" <?php if(@$ThirdDiscipline == "277"){ echo "selected='selected'";} ?>>Global Change, Society and Sustainability</option>
<option value="278" <?php if(@$ThirdDiscipline == "278"){ echo "selected='selected'";} ?>>GMS (other)</option>
<option value="279" <?php if(@$ThirdDiscipline == "279"){ echo "selected='selected'";} ?>>Graphics and Visualization</option>
<option value="280" <?php if(@$ThirdDiscipline == "280"){ echo "selected='selected'";} ?>>Gynaecology</option>
<option value="281" <?php if(@$ThirdDiscipline == "281"){ echo "selected='selected'";} ?>>Haematology</option>
<option value="282" <?php if(@$ThirdDiscipline == "282"){ echo "selected='selected'";} ?>>Health</option>
<option value="283" <?php if(@$ThirdDiscipline == "283"){ echo "selected='selected'";} ?>>Health Economics</option>
<option value="284" <?php if(@$ThirdDiscipline == "284"){ echo "selected='selected'";} ?>>Health Informatics</option>
<option value="285" <?php if(@$ThirdDiscipline == "285"){ echo "selected='selected'";} ?>>Health Promotion</option>
<option value="286" <?php if(@$ThirdDiscipline == "286"){ echo "selected='selected'";} ?>>Health Promotion </option>
<option value="287" <?php if(@$ThirdDiscipline == "287"){ echo "selected='selected'";} ?>>Health promotion &  Diesease Prevention</option>
<option value="288" <?php if(@$ThirdDiscipline == "288"){ echo "selected='selected'";} ?>>Health Promotion & Diease Prevention</option>
<option value="289" <?php if(@$ThirdDiscipline == "289"){ echo "selected='selected'";} ?>>Health Promotion & Disease Prevention</option>
<option value="290" <?php if(@$ThirdDiscipline == "290"){ echo "selected='selected'";} ?>>Health Sciences</option>
<option value="291" <?php if(@$ThirdDiscipline == "291"){ echo "selected='selected'";} ?>>Health Systems & Research</option>
<option value="292" <?php if(@$ThirdDiscipline == "292"){ echo "selected='selected'";} ?>>Health Systems Research</option>
<option value="293" <?php if(@$ThirdDiscipline == "293"){ echo "selected='selected'";} ?>>Health Technology</option>
<option value="294" <?php if(@$ThirdDiscipline == "294"){ echo "selected='selected'";} ?>>Heath Economics</option>
<option value="295" <?php if(@$ThirdDiscipline == "295"){ echo "selected='selected'";} ?>>Historical studies</option>
<option value="296" <?php if(@$ThirdDiscipline == "296"){ echo "selected='selected'";} ?>>History of arts</option>
<option value="297" <?php if(@$ThirdDiscipline == "297"){ echo "selected='selected'";} ?>>HMS (other)</option>
<option value="298" <?php if(@$ThirdDiscipline == "298"){ echo "selected='selected'";} ?>>Home economics</option>
<option value="299" <?php if(@$ThirdDiscipline == "299"){ echo "selected='selected'";} ?>>Horticulture</option>
<option value="300" <?php if(@$ThirdDiscipline == "300"){ echo "selected='selected'";} ?>>Horticulture </option>
<option value="301" <?php if(@$ThirdDiscipline == "301"){ echo "selected='selected'";} ?>>Human anatomy and physiology</option>
<option value="302" <?php if(@$ThirdDiscipline == "302"){ echo "selected='selected'";} ?>>Human Computer Interaction</option>
<option value="303" <?php if(@$ThirdDiscipline == "303"){ echo "selected='selected'";} ?>>Human geography</option>
<option value="304" <?php if(@$ThirdDiscipline == "304"){ echo "selected='selected'";} ?>>Human Movement science</option>
<option value="305" <?php if(@$ThirdDiscipline == "305"){ echo "selected='selected'";} ?>>Human Movement Sciences</option>
<option value="306" <?php if(@$ThirdDiscipline == "306"){ echo "selected='selected'";} ?>>Human Physiology</option>
<option value="307" <?php if(@$ThirdDiscipline == "307"){ echo "selected='selected'";} ?>>Human Resources</option>
<option value="308" <?php if(@$ThirdDiscipline == "308"){ echo "selected='selected'";} ?>>Human Systems Research</option>
<option value="309" <?php if(@$ThirdDiscipline == "309"){ echo "selected='selected'";} ?>>Humanities</option>
<option value="310" <?php if(@$ThirdDiscipline == "310"){ echo "selected='selected'";} ?>>Humanities and Arts</option>
<option value="311" <?php if(@$ThirdDiscipline == "311"){ echo "selected='selected'";} ?>>Hydrology</option>
<option value="312" <?php if(@$ThirdDiscipline == "312"){ echo "selected='selected'";} ?>>ICT</option>
<option value="313" <?php if(@$ThirdDiscipline == "313"){ echo "selected='selected'";} ?>>Immunology</option>
<option value="314" <?php if(@$ThirdDiscipline == "314"){ echo "selected='selected'";} ?>>Immunology, Virology and Infectious diseases</option>
<option value="315" <?php if(@$ThirdDiscipline == "315"){ echo "selected='selected'";} ?>>Indigenous Knowledge Systems</option>
<option value="316" <?php if(@$ThirdDiscipline == "316"){ echo "selected='selected'";} ?>>Industrial Biotechnology</option>
<option value="317" <?php if(@$ThirdDiscipline == "317"){ echo "selected='selected'";} ?>>Industrial design</option>
<option value="318" <?php if(@$ThirdDiscipline == "318"){ echo "selected='selected'";} ?>>Industrial Engineering</option>
<option value="319" <?php if(@$ThirdDiscipline == "319"){ echo "selected='selected'";} ?>>Industrial Engineering & Operations Research</option>
<option value="320" <?php if(@$ThirdDiscipline == "320"){ echo "selected='selected'";} ?>>Industrial Psychology</option>
<option value="321" <?php if(@$ThirdDiscipline == "321"){ echo "selected='selected'";} ?>>Industrial Psychology & Sociology</option>
<option value="322" <?php if(@$ThirdDiscipline == "322"){ echo "selected='selected'";} ?>>Infectious Diseases</option>
<option value="323" <?php if(@$ThirdDiscipline == "323"){ echo "selected='selected'";} ?>>Infomation Systems & Technologies</option>
<option value="324" <?php if(@$ThirdDiscipline == "324"){ echo "selected='selected'";} ?>>Information  & Computer Technologies</option>
<option value="325" <?php if(@$ThirdDiscipline == "325"){ echo "selected='selected'";} ?>>Information & Computer Science</option>
<option value="326" <?php if(@$ThirdDiscipline == "326"){ echo "selected='selected'";} ?>>Information & Computer Sciences</option>
<option value="327" <?php if(@$ThirdDiscipline == "327"){ echo "selected='selected'";} ?>>Information & Computer Technologies</option>
<option value="328" <?php if(@$ThirdDiscipline == "328"){ echo "selected='selected'";} ?>>Information & Computer Technology</option>
<option value="329" <?php if(@$ThirdDiscipline == "329"){ echo "selected='selected'";} ?>>Information & Library Science</option>
<option value="330" <?php if(@$ThirdDiscipline == "330"){ echo "selected='selected'";} ?>>Information & Library Sciences</option>
<option value="331" <?php if(@$ThirdDiscipline == "331"){ echo "selected='selected'";} ?>>Information and Communication Technology (ICT)</option>
<option value="332" <?php if(@$ThirdDiscipline == "332"){ echo "selected='selected'";} ?>>Information and Computer science</option>
<option value="333" <?php if(@$ThirdDiscipline == "333"){ echo "selected='selected'";} ?>>Information Communication Technology</option>
<option value="334" <?php if(@$ThirdDiscipline == "334"){ echo "selected='selected'";} ?>>Information Engineering</option>
<option value="335" <?php if(@$ThirdDiscipline == "335"){ echo "selected='selected'";} ?>>Information Management</option>
<option value="336" <?php if(@$ThirdDiscipline == "336"){ echo "selected='selected'";} ?>>Information Mangagement</option>
<option value="337" <?php if(@$ThirdDiscipline == "337"){ echo "selected='selected'";} ?>>Information Science</option>
<option value="338" <?php if(@$ThirdDiscipline == "338"){ echo "selected='selected'";} ?>>Information Systems</option>
<option value="339" <?php if(@$ThirdDiscipline == "339"){ echo "selected='selected'";} ?>>Information Systems & Technologies</option>
<option value="340" <?php if(@$ThirdDiscipline == "340"){ echo "selected='selected'";} ?>>Information Systems & Technology</option>
<option value="341" <?php if(@$ThirdDiscipline == "341"){ echo "selected='selected'";} ?>>Information Technology</option>
<option value="342" <?php if(@$ThirdDiscipline == "342"){ echo "selected='selected'";} ?>>Information, Communication, Control Systems</option>
<option value="343" <?php if(@$ThirdDiscipline == "343"){ echo "selected='selected'";} ?>>Informations Systems</option>
<option value="344" <?php if(@$ThirdDiscipline == "344"){ echo "selected='selected'";} ?>>Innovation & Technology Transfer</option>
<option value="345" <?php if(@$ThirdDiscipline == "345"){ echo "selected='selected'";} ?>>Inorganic Chemistry</option>
<option value="346" <?php if(@$ThirdDiscipline == "346"){ echo "selected='selected'";} ?>>Intensive care</option>
<option value="347" <?php if(@$ThirdDiscipline == "347"){ echo "selected='selected'";} ?>>International law</option>
<option value="348" <?php if(@$ThirdDiscipline == "348"){ echo "selected='selected'";} ?>>International Relations</option>
<option value="349" <?php if(@$ThirdDiscipline == "349"){ echo "selected='selected'";} ?>>Invertebrate Taxonomy</option>
<option value="350" <?php if(@$ThirdDiscipline == "350"){ echo "selected='selected'";} ?>>IT Graphic Design</option>
<option value="351" <?php if(@$ThirdDiscipline == "351"){ echo "selected='selected'";} ?>>IT-Graphic Design</option>
<option value="352" <?php if(@$ThirdDiscipline == "352"){ echo "selected='selected'";} ?>>Jurisprudence</option>
<option value="353" <?php if(@$ThirdDiscipline == "353"){ echo "selected='selected'";} ?>>Knowledge Management (Records Administration)</option>
<option value="354" <?php if(@$ThirdDiscipline == "354"){ echo "selected='selected'";} ?>>Labour, social service, education and cultural law</option>
<option value="355" <?php if(@$ThirdDiscipline == "355"){ echo "selected='selected'";} ?>>Languages</option>
<option value="356" <?php if(@$ThirdDiscipline == "356"){ echo "selected='selected'";} ?>>Languages & Literature</option>
<option value="357" <?php if(@$ThirdDiscipline == "357"){ echo "selected='selected'";} ?>>Languages and literature</option>
<option value="358" <?php if(@$ThirdDiscipline == "358"){ echo "selected='selected'";} ?>>Law</option>
<option value="359" <?php if(@$ThirdDiscipline == "359"){ echo "selected='selected'";} ?>>Laws (Statutes), regulations, cases</option>
<option value="360" <?php if(@$ThirdDiscipline == "360"){ echo "selected='selected'";} ?>>Leadership</option>
<option value="361" <?php if(@$ThirdDiscipline == "361"){ echo "selected='selected'";} ?>>Legal history</option>
<option value="362" <?php if(@$ThirdDiscipline == "362"){ echo "selected='selected'";} ?>>Librarianship</option>
<option value="363" <?php if(@$ThirdDiscipline == "363"){ echo "selected='selected'";} ?>>Library and Information Sciences</option>
<option value="364" <?php if(@$ThirdDiscipline == "364"){ echo "selected='selected'";} ?>>Library Science</option>
<option value="365" <?php if(@$ThirdDiscipline == "365"){ echo "selected='selected'";} ?>>Library Sciences</option>
<option value="366" <?php if(@$ThirdDiscipline == "366"){ echo "selected='selected'";} ?>>Library Services</option>
<option value="367" <?php if(@$ThirdDiscipline == "367"){ echo "selected='selected'";} ?>>Limnology</option>
<option value="368" <?php if(@$ThirdDiscipline == "368"){ echo "selected='selected'";} ?>>Linguistics</option>
<option value="369" <?php if(@$ThirdDiscipline == "369"){ echo "selected='selected'";} ?>>Literature</option>
<option value="370" <?php if(@$ThirdDiscipline == "370"){ echo "selected='selected'";} ?>>Logic or Foundations of Mathematics</option>
<option value="371" <?php if(@$ThirdDiscipline == "371"){ echo "selected='selected'";} ?>>Machine Learning</option>
<option value="372" <?php if(@$ThirdDiscipline == "372"){ echo "selected='selected'";} ?>>Macro-Invertebrates</option>
<option value="373" <?php if(@$ThirdDiscipline == "373"){ echo "selected='selected'";} ?>>Macromolecular, Supramolecular, and Nanochemistry</option>
<option value="374" <?php if(@$ThirdDiscipline == "374"){ echo "selected='selected'";} ?>>Magnetospheric Physics</option>
<option value="375" <?php if(@$ThirdDiscipline == "375"){ echo "selected='selected'";} ?>>Management</option>
<option value="376" <?php if(@$ThirdDiscipline == "376"){ echo "selected='selected'";} ?>>Management Sciences</option>
<option value="377" <?php if(@$ThirdDiscipline == "377"){ echo "selected='selected'";} ?>>Management Studies</option>
<option value="378" <?php if(@$ThirdDiscipline == "378"){ echo "selected='selected'";} ?>>Manufacturing & Process Techniques</option>
<option value="379" <?php if(@$ThirdDiscipline == "379"){ echo "selected='selected'";} ?>>Manufacturing & Process Technologies</option>
<option value="380" <?php if(@$ThirdDiscipline == "380"){ echo "selected='selected'";} ?>>Marine Biology</option>
<option value="381" <?php if(@$ThirdDiscipline == "381"){ echo "selected='selected'";} ?>>Marine Engineering & Naval Architecture</option>
<option value="382" <?php if(@$ThirdDiscipline == "382"){ echo "selected='selected'";} ?>>Marine engineering and navel architecture</option>
<option value="383" <?php if(@$ThirdDiscipline == "383"){ echo "selected='selected'";} ?>>Marine Geology and Geophysics</option>
<option value="384" <?php if(@$ThirdDiscipline == "384"){ echo "selected='selected'";} ?>>Marine Sciences</option>
<option value="385" <?php if(@$ThirdDiscipline == "385"){ echo "selected='selected'";} ?>>Marketing</option>
<option value="386" <?php if(@$ThirdDiscipline == "386"){ echo "selected='selected'";} ?>>Material Science & Technologies</option>
<option value="387" <?php if(@$ThirdDiscipline == "387"){ echo "selected='selected'";} ?>>Material Sciences & Technologies</option>
<option value="388" <?php if(@$ThirdDiscipline == "388"){ echo "selected='selected'";} ?>>Materials and Manufacturing</option>
<option value="389" <?php if(@$ThirdDiscipline == "389"){ echo "selected='selected'";} ?>>Materials engineering</option>
<option value="390" <?php if(@$ThirdDiscipline == "390"){ echo "selected='selected'";} ?>>Materials theory and Research</option>
<option value="391" <?php if(@$ThirdDiscipline == "391"){ echo "selected='selected'";} ?>>Mathematical Biology</option>
<option value="392" <?php if(@$ThirdDiscipline == "392"){ echo "selected='selected'";} ?>>Mathematical Science</option>
<option value="393" <?php if(@$ThirdDiscipline == "393"){ echo "selected='selected'";} ?>>Mathematical Sciences</option>
<option value="394" <?php if(@$ThirdDiscipline == "394"){ echo "selected='selected'";} ?>>Mathematics</option>
<option value="395" <?php if(@$ThirdDiscipline == "395"){ echo "selected='selected'";} ?>>Mathematics (other)</option>
<option value="396" <?php if(@$ThirdDiscipline == "396"){ echo "selected='selected'";} ?>>Mathematics Education</option>
<option value="397" <?php if(@$ThirdDiscipline == "397"){ echo "selected='selected'";} ?>>Mechanical Engineering</option>
<option value="398" <?php if(@$ThirdDiscipline == "398"){ echo "selected='selected'";} ?>>Mechanics</option>
<option value="399" <?php if(@$ThirdDiscipline == "399"){ echo "selected='selected'";} ?>>Mechnical Engineering</option>
<option value="400" <?php if(@$ThirdDiscipline == "400"){ echo "selected='selected'";} ?>>Media & Communications</option>
<option value="401" <?php if(@$ThirdDiscipline == "401"){ echo "selected='selected'";} ?>>Media Studies</option>
<option value="402" <?php if(@$ThirdDiscipline == "402"){ echo "selected='selected'";} ?>>Medical Biotechnology</option>
<option value="403" <?php if(@$ThirdDiscipline == "403"){ echo "selected='selected'";} ?>>Medical engineering</option>
<option value="404" <?php if(@$ThirdDiscipline == "404"){ echo "selected='selected'";} ?>>Medical Microbiology</option>
<option value="405" <?php if(@$ThirdDiscipline == "405"){ echo "selected='selected'";} ?>>Medical Microbiology </option>
<option value="406" <?php if(@$ThirdDiscipline == "406"){ echo "selected='selected'";} ?>>Medical Sciences</option>
<option value="407" <?php if(@$ThirdDiscipline == "407"){ echo "selected='selected'";} ?>>Medical sciences: Basic</option>
<option value="408" <?php if(@$ThirdDiscipline == "408"){ echo "selected='selected'";} ?>>Medical sciences: Clinical</option>
<option value="409" <?php if(@$ThirdDiscipline == "409"){ echo "selected='selected'";} ?>>Medical Technologies</option>
<option value="410" <?php if(@$ThirdDiscipline == "410"){ echo "selected='selected'";} ?>>Medical Virology</option>
<option value="411" <?php if(@$ThirdDiscipline == "411"){ echo "selected='selected'";} ?>>Medicinal Plant Research</option>
<option value="412" <?php if(@$ThirdDiscipline == "412"){ echo "selected='selected'";} ?>>Mental Health & Substance Abuse</option>
<option value="413" <?php if(@$ThirdDiscipline == "413"){ echo "selected='selected'";} ?>>Mental health and substance abuse</option>
<option value="414" <?php if(@$ThirdDiscipline == "414"){ echo "selected='selected'";} ?>>Metabolic diseases</option>
<option value="415" <?php if(@$ThirdDiscipline == "415"){ echo "selected='selected'";} ?>>Metallic materials</option>
<option value="416" <?php if(@$ThirdDiscipline == "416"){ echo "selected='selected'";} ?>>Metallurgical Engineering</option>
<option value="417" <?php if(@$ThirdDiscipline == "417"){ echo "selected='selected'";} ?>>Microbiology</option>
<option value="418" <?php if(@$ThirdDiscipline == "418"){ echo "selected='selected'";} ?>>Military and defence law</option>
<option value="419" <?php if(@$ThirdDiscipline == "419"){ echo "selected='selected'";} ?>>Mining and Mineral Processing</option>
<option value="420" <?php if(@$ThirdDiscipline == "420"){ echo "selected='selected'";} ?>>Mining engineering</option>
<option value="421" <?php if(@$ThirdDiscipline == "421"){ echo "selected='selected'";} ?>>Molecular & Cell Biology</option>
<option value="422" <?php if(@$ThirdDiscipline == "422"){ echo "selected='selected'";} ?>>Molecular and Cell Biology</option>
<option value="423" <?php if(@$ThirdDiscipline == "423"){ echo "selected='selected'";} ?>>Molecular cell biology</option>
<option value="424" <?php if(@$ThirdDiscipline == "424"){ echo "selected='selected'";} ?>>Molecular modelling</option>
<option value="425" <?php if(@$ThirdDiscipline == "425"){ echo "selected='selected'";} ?>>Morphology</option>
<option value="426" <?php if(@$ThirdDiscipline == "426"){ echo "selected='selected'";} ?>>Music</option>
<option value="427" <?php if(@$ThirdDiscipline == "427"){ echo "selected='selected'";} ?>>Musicology</option>
<option value="428" <?php if(@$ThirdDiscipline == "428"){ echo "selected='selected'";} ?>>Nanotechnology</option>
<option value="429" <?php if(@$ThirdDiscipline == "429"){ echo "selected='selected'";} ?>>Natural Language Processing</option>
<option value="430" <?php if(@$ThirdDiscipline == "430"){ echo "selected='selected'";} ?>>Natural Science</option>
<option value="431" <?php if(@$ThirdDiscipline == "431"){ echo "selected='selected'";} ?>>Natural Sciences</option>
<option value="432" <?php if(@$ThirdDiscipline == "432"){ echo "selected='selected'";} ?>>Neurology</option>
<option value="433" <?php if(@$ThirdDiscipline == "433"){ echo "selected='selected'";} ?>>Neurology and Psychiatry</option>
<option value="434" <?php if(@$ThirdDiscipline == "434"){ echo "selected='selected'";} ?>>Neuroscience</option>
<option value="435" <?php if(@$ThirdDiscipline == "435"){ echo "selected='selected'";} ?>>Neurosciences</option>
<option value="436" <?php if(@$ThirdDiscipline == "436"){ echo "selected='selected'";} ?>>NLS (other)</option>
<option value="437" <?php if(@$ThirdDiscipline == "437"){ echo "selected='selected'";} ?>>Nuclear Engineering</option>
<option value="438" <?php if(@$ThirdDiscipline == "438"){ echo "selected='selected'";} ?>>Nuclear Medicine & Organ Imaging</option>
<option value="439" <?php if(@$ThirdDiscipline == "439"){ echo "selected='selected'";} ?>>Nuclear physics</option>
<option value="440" <?php if(@$ThirdDiscipline == "440"){ echo "selected='selected'";} ?>>Nuclear Technologies in Medicine and Biosciences</option>
<option value="441" <?php if(@$ThirdDiscipline == "441"){ echo "selected='selected'";} ?>>Nursing Science</option>
<option value="442" <?php if(@$ThirdDiscipline == "442"){ echo "selected='selected'";} ?>>Nutrition</option>
<option value="443" <?php if(@$ThirdDiscipline == "443"){ echo "selected='selected'";} ?>>Nutrition </option>
<option value="444" <?php if(@$ThirdDiscipline == "444"){ echo "selected='selected'";} ?>>Nutrition & Metabolism</option>
<option value="445" <?php if(@$ThirdDiscipline == "445"){ echo "selected='selected'";} ?>>Nutrition and Pediatrics</option>
<option value="446" <?php if(@$ThirdDiscipline == "446"){ echo "selected='selected'";} ?>>Obstetrics & Maternal Health</option>
<option value="447" <?php if(@$ThirdDiscipline == "447"){ echo "selected='selected'";} ?>>Obstetrics and maternal health</option>
<option value="448" <?php if(@$ThirdDiscipline == "448"){ echo "selected='selected'";} ?>>Occupational health</option>
<option value="449" <?php if(@$ThirdDiscipline == "449"){ echo "selected='selected'";} ?>>Oceanography</option>
<option value="450" <?php if(@$ThirdDiscipline == "450"){ echo "selected='selected'";} ?>>Oceanology</option>
<option value="451" <?php if(@$ThirdDiscipline == "451"){ echo "selected='selected'";} ?>>Oncology</option>
<option value="452" <?php if(@$ThirdDiscipline == "452"){ echo "selected='selected'";} ?>>Operations research</option>
<option value="453" <?php if(@$ThirdDiscipline == "453"){ echo "selected='selected'";} ?>>Ophthalmology</option>
<option value="454" <?php if(@$ThirdDiscipline == "454"){ echo "selected='selected'";} ?>>Optical Engineering</option>
<option value="455" <?php if(@$ThirdDiscipline == "455"){ echo "selected='selected'";} ?>>Optics</option>
<option value="456" <?php if(@$ThirdDiscipline == "456"){ echo "selected='selected'";} ?>>Organic Chemistry</option>
<option value="457" <?php if(@$ThirdDiscipline == "457"){ echo "selected='selected'";} ?>>Organic Sciences</option>
<option value="458" <?php if(@$ThirdDiscipline == "458"){ echo "selected='selected'";} ?>>Organismal Biology</option>
<option value="459" <?php if(@$ThirdDiscipline == "459"){ echo "selected='selected'";} ?>>Orthopaedics</option>
<option value="460" <?php if(@$ThirdDiscipline == "460"){ echo "selected='selected'";} ?>>Other</option>
<option value="461" <?php if(@$ThirdDiscipline == "461"){ echo "selected='selected'";} ?>>Other information and computer technologies</option>
<option value="462" <?php if(@$ThirdDiscipline == "462"){ echo "selected='selected'";} ?>>Otorhinolaryngology</option>
<option value="463" <?php if(@$ThirdDiscipline == "463"){ echo "selected='selected'";} ?>>Paediatrics & Child Health</option>
<option value="464" <?php if(@$ThirdDiscipline == "464"){ echo "selected='selected'";} ?>>Paediatrics and child health</option>
<option value="465" <?php if(@$ThirdDiscipline == "465"){ echo "selected='selected'";} ?>>Painting</option>
<option value="466" <?php if(@$ThirdDiscipline == "466"){ echo "selected='selected'";} ?>>Palaeontology</option>
<option value="467" <?php if(@$ThirdDiscipline == "467"){ echo "selected='selected'";} ?>>Palaeosciences</option>
<option value="468" <?php if(@$ThirdDiscipline == "468"){ echo "selected='selected'";} ?>>Paleoclimate</option>
<option value="469" <?php if(@$ThirdDiscipline == "469"){ echo "selected='selected'";} ?>>Paleontology</option>
<option value="470" <?php if(@$ThirdDiscipline == "470"){ echo "selected='selected'";} ?>>Paleontology and Paleobiology</option>
<option value="471" <?php if(@$ThirdDiscipline == "471"){ echo "selected='selected'";} ?>>Parasitology</option>
<option value="472" <?php if(@$ThirdDiscipline == "472"){ echo "selected='selected'";} ?>>Particle</option>
<option value="473" <?php if(@$ThirdDiscipline == "473"){ echo "selected='selected'";} ?>>Particle & Plasma Physics</option>
<option value="474" <?php if(@$ThirdDiscipline == "474"){ echo "selected='selected'";} ?>>Particle and plasma physics</option>
<option value="475" <?php if(@$ThirdDiscipline == "475"){ echo "selected='selected'";} ?>>Patient-oriented research</option>
<option value="476" <?php if(@$ThirdDiscipline == "476"){ echo "selected='selected'";} ?>>Pediatrics & Child Health</option>
<option value="477" <?php if(@$ThirdDiscipline == "477"){ echo "selected='selected'";} ?>>Performing and Creative Arts</option>
<option value="478" <?php if(@$ThirdDiscipline == "478"){ echo "selected='selected'";} ?>>Performing arts</option>
<option value="479" <?php if(@$ThirdDiscipline == "479"){ echo "selected='selected'";} ?>>Petrology</option>
<option value="480" <?php if(@$ThirdDiscipline == "480"){ echo "selected='selected'";} ?>>Pharmaceutical Science</option>
<option value="481" <?php if(@$ThirdDiscipline == "481"){ echo "selected='selected'";} ?>>Pharmaceutical Sciences</option>
<option value="482" <?php if(@$ThirdDiscipline == "482"){ echo "selected='selected'";} ?>>Pharmacology</option>
<option value="483" <?php if(@$ThirdDiscipline == "483"){ echo "selected='selected'";} ?>>Pharmacology </option>
<option value="484" <?php if(@$ThirdDiscipline == "484"){ echo "selected='selected'";} ?>>Pharmacology & Pharmaceutical Sciences</option>
<option value="485" <?php if(@$ThirdDiscipline == "485"){ echo "selected='selected'";} ?>>Phenomenological Physics</option>
<option value="486" <?php if(@$ThirdDiscipline == "486"){ echo "selected='selected'";} ?>>Philosophy</option>
<option value="487" <?php if(@$ThirdDiscipline == "487"){ echo "selected='selected'";} ?>>Photography</option>
<option value="488" <?php if(@$ThirdDiscipline == "488"){ echo "selected='selected'";} ?>>Photonic materials</option>
<option value="489" <?php if(@$ThirdDiscipline == "489"){ echo "selected='selected'";} ?>>Physcial Geopraphy </option>
<option value="490" <?php if(@$ThirdDiscipline == "490"){ echo "selected='selected'";} ?>>Physical and Dynamic Meteorology</option>
<option value="491" <?php if(@$ThirdDiscipline == "491"){ echo "selected='selected'";} ?>>Physical Chemistry</option>
<option value="492" <?php if(@$ThirdDiscipline == "492"){ echo "selected='selected'";} ?>>Physical Geography</option>
<option value="493" <?php if(@$ThirdDiscipline == "493"){ echo "selected='selected'";} ?>>Physical Oceanography</option>
<option value="494" <?php if(@$ThirdDiscipline == "494"){ echo "selected='selected'";} ?>>Physical Sciences</option>
<option value="495" <?php if(@$ThirdDiscipline == "495"){ echo "selected='selected'";} ?>>Physics</option>
<option value="496" <?php if(@$ThirdDiscipline == "496"){ echo "selected='selected'";} ?>>Physics </option>
<option value="497" <?php if(@$ThirdDiscipline == "497"){ echo "selected='selected'";} ?>>Physics (other)</option>
<option value="498" <?php if(@$ThirdDiscipline == "498"){ echo "selected='selected'";} ?>>Physics of Living Systems</option>
<option value="499" <?php if(@$ThirdDiscipline == "499"){ echo "selected='selected'";} ?>>Physiology</option>
<option value="500" <?php if(@$ThirdDiscipline == "500"){ echo "selected='selected'";} ?>>Physiology Polymer Sciences</option>
<option value="501" <?php if(@$ThirdDiscipline == "501"){ echo "selected='selected'";} ?>>Phyto-chemistry</option>
<option value="502" <?php if(@$ThirdDiscipline == "502"){ echo "selected='selected'";} ?>>Plant Biotechnology</option>
<option value="503" <?php if(@$ThirdDiscipline == "503"){ echo "selected='selected'";} ?>>Plant Pathology</option>
<option value="504" <?php if(@$ThirdDiscipline == "504"){ echo "selected='selected'";} ?>>Plant Production</option>
<option value="505" <?php if(@$ThirdDiscipline == "505"){ echo "selected='selected'";} ?>>Plant Sciences</option>
<option value="506" <?php if(@$ThirdDiscipline == "506"){ echo "selected='selected'";} ?>>Plasma</option>
<option value="507" <?php if(@$ThirdDiscipline == "507"){ echo "selected='selected'";} ?>>Podiatry</option>
<option value="508" <?php if(@$ThirdDiscipline == "508"){ echo "selected='selected'";} ?>>Polar Science</option>
<option value="509" <?php if(@$ThirdDiscipline == "509"){ echo "selected='selected'";} ?>>Policy Studies</option>
<option value="510" <?php if(@$ThirdDiscipline == "510"){ echo "selected='selected'";} ?>>Political Sciences</option>
<option value="511" <?php if(@$ThirdDiscipline == "511"){ echo "selected='selected'";} ?>>Political Sciences </option>
<option value="512" <?php if(@$ThirdDiscipline == "512"){ echo "selected='selected'";} ?>>Political Sciences & Public Policy</option>
<option value="513" <?php if(@$ThirdDiscipline == "513"){ echo "selected='selected'";} ?>>Political Studies</option>
<option value="514" <?php if(@$ThirdDiscipline == "514"){ echo "selected='selected'";} ?>>Polymer Science</option>
<option value="515" <?php if(@$ThirdDiscipline == "515"){ echo "selected='selected'";} ?>>Polymer Sciences</option>
<option value="516" <?php if(@$ThirdDiscipline == "516"){ echo "selected='selected'";} ?>>Polymers</option>
<option value="517" <?php if(@$ThirdDiscipline == "517"){ echo "selected='selected'";} ?>>Power Systems Development</option>
<option value="518" <?php if(@$ThirdDiscipline == "518"){ echo "selected='selected'";} ?>>Private law</option>
<option value="519" <?php if(@$ThirdDiscipline == "519"){ echo "selected='selected'";} ?>>Probability</option>
<option value="520" <?php if(@$ThirdDiscipline == "520"){ echo "selected='selected'";} ?>>Process Engineering</option>
<option value="521" <?php if(@$ThirdDiscipline == "521"){ echo "selected='selected'";} ?>>Process Manufacturing</option>
<option value="522" <?php if(@$ThirdDiscipline == "522"){ echo "selected='selected'";} ?>>Proteomics</option>
<option value="523" <?php if(@$ThirdDiscipline == "523"){ echo "selected='selected'";} ?>>Psychiatry</option>
<option value="524" <?php if(@$ThirdDiscipline == "524"){ echo "selected='selected'";} ?>>Psychology</option>
<option value="525" <?php if(@$ThirdDiscipline == "525"){ echo "selected='selected'";} ?>>Public Administration</option>
<option value="526" <?php if(@$ThirdDiscipline == "526"){ echo "selected='selected'";} ?>>Public and Science Policy   </option>
<option value="527" <?php if(@$ThirdDiscipline == "527"){ echo "selected='selected'";} ?>>Public Health</option>
<option value="528" <?php if(@$ThirdDiscipline == "528"){ echo "selected='selected'";} ?>>Public law</option>
<option value="529" <?php if(@$ThirdDiscipline == "529"){ echo "selected='selected'";} ?>>Public Management & Administration</option>
<option value="530" <?php if(@$ThirdDiscipline == "530"){ echo "selected='selected'";} ?>>Public management and administration</option>
<option value="531" <?php if(@$ThirdDiscipline == "531"){ echo "selected='selected'";} ?>>Public Relations</option>
<option value="532" <?php if(@$ThirdDiscipline == "532"){ echo "selected='selected'";} ?>>Quality Management</option>
<option value="533" <?php if(@$ThirdDiscipline == "533"){ echo "selected='selected'";} ?>>Quantity surveying</option>
<option value="534" <?php if(@$ThirdDiscipline == "534"){ echo "selected='selected'";} ?>>R & D Psychology</option>
<option value="535" <?php if(@$ThirdDiscipline == "535"){ echo "selected='selected'";} ?>>R & D Sociology</option>
<option value="536" <?php if(@$ThirdDiscipline == "536"){ echo "selected='selected'";} ?>>R&D Psychology</option>
<option value="537" <?php if(@$ThirdDiscipline == "537"){ echo "selected='selected'";} ?>>Rehabilitation Medicine</option>
<option value="538" <?php if(@$ThirdDiscipline == "538"){ echo "selected='selected'";} ?>>Religion</option>
<option value="539" <?php if(@$ThirdDiscipline == "539"){ echo "selected='selected'";} ?>>Religious legal systems</option>
<option value="540" <?php if(@$ThirdDiscipline == "540"){ echo "selected='selected'";} ?>>Religious studies</option>
<option value="541" <?php if(@$ThirdDiscipline == "541"){ echo "selected='selected'";} ?>>Remote Sensing</option>
<option value="542" <?php if(@$ThirdDiscipline == "542"){ echo "selected='selected'";} ?>>Renewable Energy</option>
<option value="543" <?php if(@$ThirdDiscipline == "543"){ echo "selected='selected'";} ?>>Research Management</option>
<option value="544" <?php if(@$ThirdDiscipline == "544"){ echo "selected='selected'";} ?>>Research Management with Mathematics</option>
<option value="545" <?php if(@$ThirdDiscipline == "545"){ echo "selected='selected'";} ?>>Research Management, Research Support & Administration</option>
<option value="546" <?php if(@$ThirdDiscipline == "546"){ echo "selected='selected'";} ?>>Respiratory diseases</option>
<option value="547" <?php if(@$ThirdDiscipline == "547"){ echo "selected='selected'";} ?>>Rheumatology</option>
<option value="548" <?php if(@$ThirdDiscipline == "548"){ echo "selected='selected'";} ?>>Robotics and Computer Vision</option>
<option value="549" <?php if(@$ThirdDiscipline == "549"){ echo "selected='selected'";} ?>>Rural Development</option>
<option value="550" <?php if(@$ThirdDiscipline == "550"){ echo "selected='selected'";} ?>>Science & Statistics</option>
<option value="551" <?php if(@$ThirdDiscipline == "551"){ echo "selected='selected'";} ?>>Science & Technologies</option>
<option value="552" <?php if(@$ThirdDiscipline == "552"){ echo "selected='selected'";} ?>>Science & Technology</option>
<option value="553" <?php if(@$ThirdDiscipline == "553"){ echo "selected='selected'";} ?>>Science and state</option>
<option value="554" <?php if(@$ThirdDiscipline == "554"){ echo "selected='selected'";} ?>>Science Education</option>
<option value="555" <?php if(@$ThirdDiscipline == "555"){ echo "selected='selected'";} ?>>Science Education </option>
<option value="556" <?php if(@$ThirdDiscipline == "556"){ echo "selected='selected'";} ?>>Science Journalism</option>
<option value="557" <?php if(@$ThirdDiscipline == "557"){ echo "selected='selected'";} ?>>Sculpture</option>
<option value="558" <?php if(@$ThirdDiscipline == "558"){ echo "selected='selected'";} ?>>Sedimentary Geology</option>
<option value="559" <?php if(@$ThirdDiscipline == "559"){ echo "selected='selected'";} ?>>Social & Economic Geography</option>
<option value="560" <?php if(@$ThirdDiscipline == "560"){ echo "selected='selected'";} ?>>Social Science</option>
<option value="561" <?php if(@$ThirdDiscipline == "561"){ echo "selected='selected'";} ?>>Social Science and Humanities</option>
<option value="562" <?php if(@$ThirdDiscipline == "562"){ echo "selected='selected'";} ?>>Social Sciences</option>
<option value="563" <?php if(@$ThirdDiscipline == "563"){ echo "selected='selected'";} ?>>Social Sciences and Humanities</option>
<option value="564" <?php if(@$ThirdDiscipline == "564"){ echo "selected='selected'";} ?>>Social work</option>
<option value="565" <?php if(@$ThirdDiscipline == "565"){ echo "selected='selected'";} ?>>Social Work </option>
<option value="566" <?php if(@$ThirdDiscipline == "566"){ echo "selected='selected'";} ?>>Sociology</option>
<option value="567" <?php if(@$ThirdDiscipline == "567"){ echo "selected='selected'";} ?>>Software Engineering</option>
<option value="568" <?php if(@$ThirdDiscipline == "568"){ echo "selected='selected'";} ?>>Soil & Water  Sciences</option>
<option value="569" <?php if(@$ThirdDiscipline == "569"){ echo "selected='selected'";} ?>>Soil & Water Sciences</option>
<option value="570" <?php if(@$ThirdDiscipline == "570"){ echo "selected='selected'";} ?>>Solar Physics</option>
<option value="571" <?php if(@$ThirdDiscipline == "571"){ echo "selected='selected'";} ?>>Solid State</option>
<option value="572" <?php if(@$ThirdDiscipline == "572"){ echo "selected='selected'";} ?>>Space & Earth Science</option>
<option value="573" <?php if(@$ThirdDiscipline == "573"){ echo "selected='selected'";} ?>>Space and earth science</option>
<option value="574" <?php if(@$ThirdDiscipline == "574"){ echo "selected='selected'";} ?>>Space Science</option>
<option value="575" <?php if(@$ThirdDiscipline == "575"){ echo "selected='selected'";} ?>>Space Sciences</option>
<option value="576" <?php if(@$ThirdDiscipline == "576"){ echo "selected='selected'";} ?>>Sport Sciences</option>
<option value="577" <?php if(@$ThirdDiscipline == "577"){ echo "selected='selected'";} ?>>Sports & Recreational Arts</option>
<option value="578" <?php if(@$ThirdDiscipline == "578"){ echo "selected='selected'";} ?>>Sports & Recreational Arts </option>
<option value="579" <?php if(@$ThirdDiscipline == "579"){ echo "selected='selected'";} ?>>Sports Medicine</option>
<option value="580" <?php if(@$ThirdDiscipline == "580"){ echo "selected='selected'";} ?>>Sports Sciences</option>
<option value="581" <?php if(@$ThirdDiscipline == "581"){ echo "selected='selected'";} ?>>SSH (other)</option>
<option value="582" <?php if(@$ThirdDiscipline == "582"){ echo "selected='selected'";} ?>>Statistics</option>
<option value="583" <?php if(@$ThirdDiscipline == "583"){ echo "selected='selected'";} ?>>Statistics & Probability</option>
<option value="584" <?php if(@$ThirdDiscipline == "584"){ echo "selected='selected'";} ?>>Stem cell and regenerative biology</option>
<option value="585" <?php if(@$ThirdDiscipline == "585"){ echo "selected='selected'";} ?>>STEM Education and Learning Research (other)</option>
<option value="586" <?php if(@$ThirdDiscipline == "586"){ echo "selected='selected'";} ?>>Strategy</option>
<option value="587" <?php if(@$ThirdDiscipline == "587"){ echo "selected='selected'";} ?>>Structural Biology</option>
<option value="588" <?php if(@$ThirdDiscipline == "588"){ echo "selected='selected'";} ?>>Surgery</option>
<option value="589" <?php if(@$ThirdDiscipline == "589"){ echo "selected='selected'";} ?>>Sustainable Agriculture </option>
<option value="590" <?php if(@$ThirdDiscipline == "590"){ echo "selected='selected'";} ?>>Sustainable Chemistry</option>
<option value="591" <?php if(@$ThirdDiscipline == "591"){ echo "selected='selected'";} ?>>Sustainable Development</option>
<option value="592" <?php if(@$ThirdDiscipline == "592"){ echo "selected='selected'";} ?>>Systematics and Biodiversity</option>
<option value="593" <?php if(@$ThirdDiscipline == "593"){ echo "selected='selected'";} ?>>Systems and Molecular Biology</option>
<option value="594" <?php if(@$ThirdDiscipline == "594"){ echo "selected='selected'";} ?>>Systems Engineering</option>
<option value="595" <?php if(@$ThirdDiscipline == "595"){ echo "selected='selected'";} ?>>Tax law</option>
<option value="596" <?php if(@$ThirdDiscipline == "596"){ echo "selected='selected'";} ?>>Taxonomy</option>
<option value="597" <?php if(@$ThirdDiscipline == "597"){ echo "selected='selected'";} ?>>Technologies & Applied Sciences</option>
<option value="598" <?php if(@$ThirdDiscipline == "598"){ echo "selected='selected'";} ?>>Technologies and applied sciences</option>
<option value="599" <?php if(@$ThirdDiscipline == "599"){ echo "selected='selected'";} ?>>Technology Education</option>
<option value="600" <?php if(@$ThirdDiscipline == "600"){ echo "selected='selected'";} ?>>Tectonics</option>
<option value="601" <?php if(@$ThirdDiscipline == "601"){ echo "selected='selected'";} ?>>Theatre</option>
<option value="602" <?php if(@$ThirdDiscipline == "602"){ echo "selected='selected'";} ?>>Theology</option>
<option value="603" <?php if(@$ThirdDiscipline == "603"){ echo "selected='selected'";} ?>>Theology and Religion</option>
<option value="604" <?php if(@$ThirdDiscipline == "604"){ echo "selected='selected'";} ?>>Theoretical & Condensed Matter Physics</option>
<option value="605" <?php if(@$ThirdDiscipline == "605"){ echo "selected='selected'";} ?>>Theoretical Physics</option>
<option value="606" <?php if(@$ThirdDiscipline == "606"){ echo "selected='selected'";} ?>>Topology</option>
<option value="607" <?php if(@$ThirdDiscipline == "607"){ echo "selected='selected'";} ?>>Tourism</option>
<option value="608" <?php if(@$ThirdDiscipline == "608"){ echo "selected='selected'";} ?>>Town & Regional Planning</option>
<option value="609" <?php if(@$ThirdDiscipline == "609"){ echo "selected='selected'";} ?>>Toxicology</option>
<option value="610" <?php if(@$ThirdDiscipline == "610"){ echo "selected='selected'";} ?>>Trade and commerce</option>
<option value="611" <?php if(@$ThirdDiscipline == "611"){ echo "selected='selected'";} ?>>Transportation Studies</option>
<option value="612" <?php if(@$ThirdDiscipline == "612"){ echo "selected='selected'";} ?>>Trauma</option>
<option value="613" <?php if(@$ThirdDiscipline == "613"){ echo "selected='selected'";} ?>>Urban and Regional Planning</option>
<option value="614" <?php if(@$ThirdDiscipline == "614"){ echo "selected='selected'";} ?>>Veterinary Microbiology</option>
<option value="615" <?php if(@$ThirdDiscipline == "615"){ echo "selected='selected'";} ?>>Veterinary Nursing</option>
<option value="616" <?php if(@$ThirdDiscipline == "616"){ echo "selected='selected'";} ?>>Veterinary Science</option>
<option value="617" <?php if(@$ThirdDiscipline == "617"){ echo "selected='selected'";} ?>>Veterinary Sciences</option>
<option value="618" <?php if(@$ThirdDiscipline == "618"){ echo "selected='selected'";} ?>>Virology</option>
<option value="622" <?php if(@$ThirdDiscipline == "622"){ echo "selected='selected'";} ?>>Waste and Circular Economy</option>
<option value="619" <?php if(@$ThirdDiscipline == "619"){ echo "selected='selected'";} ?>>Waves</option>
<option value="620" <?php if(@$ThirdDiscipline == "620"){ echo "selected='selected'";} ?>>Wood Science </option>
<option value="621" <?php if(@$ThirdDiscipline == "621"){ echo "selected='selected'";} ?>>Zoology</option>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												<div class="col-12 d-flex justify-content-end">
												<button type="reset"
                                                        class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                    <button type="submit"
                                                        class="btn btn-primary me-1 mb-1" name="Submit" value="Submit">Submit</button>
                                                    
                                                </div>
												
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
				</div>
            </section>
				
				
				
				
				
				
				
										
		

            
        </div>
		<?php require_once("footer.php"); ?>
    </div>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
	
	<script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>

    <script src="assets/js/main.js"></script>
</body>

</html>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript">
 $(document).ready(function(){



});
</script>