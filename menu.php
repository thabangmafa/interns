<?php 

$query = "SELECT * FROM ApplicantChecklist 	
	WHERE (UserID = '".@$_SESSION['id']."' OR InstitutionID = '".@$_SESSION['InstitutionID']."')";

	$result = mysqli_query($conn, $query);
	
	$ContactDetails = '<span class="fa-fw select-all fas" style="color:red"></span>';
	$EmploymentDetails = '<span class="fa-fw select-all fas" style="color:red"></span>';
	$LanguageProficiency = '<span class="fa-fw select-all fas" style="color:red"></span>';
	$PositionAppliedFor = '<span class="fa-fw select-all fas" style="color:red"></span>';
	$PersonalProfile = '<span class="fa-fw select-all fas" style="color:red"></span>';
	$Qualifications = '<span class="fa-fw select-all fas" style="color:red"></span>';
	$RegistrationDetails = '<span class="fa-fw select-all fas" style="color:red"></span>';
	$References = '<span class="fa-fw select-all fas" style="color:red"></span>';
	$HostInstitution = '<span class="fa-fw select-all fas" style="color:red"></span>';
	$ProspectiveMentorsandRequiredInternProfile = '<span class="fa-fw select-all fas" style="color:red"></span>';
	$ProfileofRequestedInterns = '<span class="fa-fw select-all fas" style="color:red"></span>';
	$ProspectiveMentors = '<span class="fa-fw select-all fas" style="color:red"></span>';
	
	while($details = mysqli_fetch_array($result)) {
		if($details['Section'] == 'Contact Details'){
			$ContactDetails = ' <span class="fa-fw select-all fas" style="color:green"></span>';
		}
		
		if($details['Section'] == 'Employment Details'){
			$EmploymentDetails = ' <span class="fa-fw select-all fas" style="color:green"></span>';
		}
		
		if($details['Section'] == 'Language Proficiency'){
			$LanguageProficiency = ' <span class="fa-fw select-all fas" style="color:green"></span>';
		}
		
		
		if($details['Section'] == 'Position Applied For'){
			$PositionAppliedFor = ' <span class="fa-fw select-all fas" style="color:green"></span>';
		}
		
		if($details['Section'] == 'Personal Profile'){
			$PersonalProfile = ' <span class="fa-fw select-all fas" style="color:green"></span>';
		}
		
		if($details['Section'] == 'Qualifications'){
			$Qualifications = ' <span class="fa-fw select-all fas" style="color:green"></span>';
		}
		
		if($details['Section'] == 'Registration Details'){
			$RegistrationDetails = ' <span class="fa-fw select-all fas" style="color:green"></span>';
		}
		
		if($details['Section'] == 'References'){
			$References = ' <span class="fa-fw select-all fas" style="color:green"></span>';
		}
		
		if($details['Section'] == 'Host Institution'){
			$HostInstitution = ' <span class="fa-fw select-all fas" style="color:green"></span>';
		}
		
		if($details['Section'] == 'Prospective Mentors and Required Intern Profile'){
			$ProspectiveMentorsandRequiredInternProfile = ' <span class="fa-fw select-all fas" style="color:green"></span>';
		}
		
		if($details['Section'] == 'Profile of Requested Interns'){
			$ProfileofRequestedInterns = ' <span class="fa-fw select-all fas" style="color:green"></span>';
		}

		
		
	}
	
?>



        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="/"><img src="assets/images/logo/logo.png" style="width:100%" alt="Logo" srcset=""><img src="assets/images/logo/DSI.png" style="width:100%" alt="Logo" srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item <?php if($menu_item == "1"){ echo "active"; } ?>">
                            <a href="/" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
						<li class="sidebar-item  has-sub ">
                            <a href="#" class='sidebar-link '>
                                <i class="bi bi-stack <?php if($menu_item == "2"){ echo "active"; } ?>"></i>
                                <span>My Profile</span>
                            </a>
							<ul class="submenu <?php if($menu_item == "2"){ echo "active"; } ?>">
						<?php
						//Interns Menu
						if(@$_SESSION['user_type'] == '4' || @$_SESSION['user_type'] == '1'){ ?>
						
						<li class="submenu-item <?php if($title == "Registration Details"){ echo "active"; } ?>">
							<a href="user-registration.php">Registration Details <?php echo $RegistrationDetails; ?></a>
						</li>
						<li class="submenu-item <?php if($title == "Contact Details"){ echo "active"; } ?>">
							<a href="contact-details.php">Contact Details <?php echo $ContactDetails; ?></a>
						</li>
						<li class="submenu-item <?php if($title == "Language Proficiency"){ echo "active"; } ?>">
							<a href="language-proficiency.php">Language Proficiency <?php echo $LanguageProficiency; ?></a>
						</li>
						<li class="submenu-item <?php if($title == "Qualifications"){ echo "active"; } ?>">
							<a href="qualification.php">Qualifications <?php echo $Qualifications; ?></a>
						</li>
						<li class="submenu-item <?php if($title == "Personal Profile"){ echo "active"; } ?>">
							<a href="personal-profile.php">Personal Profile <?php echo $PersonalProfile; ?></a>
						</li>
						<li class="submenu-item <?php if($title == "References"){ echo "active"; } ?>">
							<a href="references.php">References <?php echo $References; ?></a>
						</li>
						<?php } 
						
						//Admin & Mentor Menu
						if(@$_SESSION['user_type'] == '2' || @$_SESSION['user_type'] == '3' || @$_SESSION['user_type'] == '1'){ ?>
						<li class="submenu-item <?php if($title == "Registration Details"){ echo "active"; } ?>">
							<a href="user-registration.php">Registration Details <?php echo $RegistrationDetails; ?></a>
						</li>
						<li class="submenu-item <?php if($title == "Contact Details"){ echo "active"; } ?>">
							<a href="contact-details.php">Contact Details <?php echo $ContactDetails; ?></a>
						</li>
						<li class="submenu-item <?php if($title == "Employment Details"){ echo "active"; } ?>">
							<a href="employment-details.php">Employment Details <?php echo $EmploymentDetails; ?></a>
						</li>
						<li class="submenu-item <?php if($title == "Qualifications"){ echo "active"; } ?>">
							<a href="qualification.php">Qualifications <?php echo $Qualifications; ?></a>
						</li>
						
						<?php } ?>
						
                            </ul>
                        </li>
						<?php if(@$_SESSION['user_type'] == '4' || @$_SESSION['user_type'] == '1'){ ?>
						<li class="sidebar-item  has-sub ">
                            <a href="#" class='sidebar-link '>
                                <i class="bi bi-stack <?php if($menu_item == "4"){ echo "active"; } ?>"></i>
                                <span>My Applications</span>
                            </a>
                            <ul class="submenu <?php if($menu_item == "4"){ echo "active"; } ?>">
							
								<li class="submenu-item <?php if($title == "Position Applied For"){ echo "active"; } ?>">
                                    <a href="position-applied-for.php">Position Applied For <?php echo $PositionAppliedFor; ?></a>
                                </li>
								<li class="submenu-item <?php if($title == "Create Application"){ echo "active"; } ?>">
                                    <a href="create-application.php">Create Application</a>
                                </li>
								
								<li class="submenu-item <?php if($title == "List of Applications"){ echo "active"; } ?>">
                                    <a href="list-applications.php">View Applications</a>
                                </li>
								
                            </ul>
                        </li>
						<?php } 


						$query = "SELECT b.* FROM HostAdministrator a
										left join LookupInstitutions b on b.InstitutionId = a.InstitutionID and b.IsActive = '1'
										WHERE a.Status = 'Approved' and a.UserID = '".$_SESSION['id']."' ORDER BY Name asc";
							$result = mysqli_query($conn, $query);
							$results = mysqli_fetch_array($result);
							
						

								if( @$_SESSION['InstitutionID'] || @$_SESSION['user_type'] == '1'){
														
						?>
						<li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack <?php if($menu_item == "3"){ echo "active"; } ?>"></i>
                                <span>Manage Host Institution</span>
                            </a>
                            <ul class="submenu <?php if($menu_item == "3"){ echo "active"; } ?>">
							<li class="submenu-item <?php if($title == "Create Host Application"){ echo "active"; } ?>">
                                    <a href="create-host-application.php">Create Host Application</a>
                                </li>
								<li class="submenu-item <?php if($title == "List of Applications"){ echo "active"; } ?>">
                                    <a href="list-host-applications.php">View Applications</a>
                                </li>
                                <!--li class="submenu-item <?php if($title == "Registration Details"){ echo "active"; } ?>">
                                    <a href="user-registration.php">Call Information Documents</a>
                                </li-->
								<!--li class="submenu-item <?php if($title == "Registration Details"){ echo "active"; } ?>">
                                    <a href="user-registration.php">Registration Details</a>
                                </li>
								<li class="submenu-item <?php if($title == "Contact Details"){ echo "active"; } ?>">
                                    <a href="contact-details.php">Contact Details</a>
                                </li-->
								<li class="submenu-item <?php if($title == "Host Institution"){ echo "active"; } ?>">
                                    <a href="host-institution.php">Institution Details <?php echo $HostInstitution; ?></a>
                                </li>
								<li class="submenu-item <?php if($title == "Prospective Mentors and Required Intern Profile"){ echo "active"; } ?>">
                                    <a href="prospective-mentors-and-required-intern-profile.php">Prospective Mentors Invitation <?php echo $ProspectiveMentorsandRequiredInternProfile; ?></a>
                                </li>
								<li class="submenu-item <?php if($title == "Profile of Requested Interns"){ echo "active"; } ?>">
                                    <a href="profile-of-requested-interns.php">Profile of Requested Intern <?php echo $ProfileofRequestedInterns; ?></a>
                                </li>
								<!--li class="submenu-item <?php if($title == "Prospective Mentors"){ echo "active"; } ?>">
                                    <a href="prospective-mentors.php">Prospective Mentors <?php //echo $ProspectiveMentors; ?></a>
                                </li-->
                                
                            </ul>
                        </li>
						<?php }
						
					
						
						
						if (@$_SESSION['user_type'] == '3' || @$_SESSION['user_type'] == '2' || @$_SESSION['user_type'] == '1') { ?>
						
						<li class="sidebar-item  <?php if($menu_item == "13"){ echo "active"; } ?> ">
                            <a href="selected-candicates.php" class='sidebar-link '>
                                <i class="bi bi-stack <?php if($menu_item == "7"){ echo "active"; } ?>"></i>
                                <span>Application Responses</span>
                            </a>
                            
                        </li>
						
						<li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack <?php if($menu_item == "12"){ echo "active"; } ?>"></i>
                                <span>Submitted Applications</span>
                            </a>
                            <ul class="submenu <?php if($menu_item == "12"){ echo "active"; } ?>">
								<li class="submenu-item <?php if($title == "Intern Applications"){ echo "active"; } ?>">
                                    <a href="institutional-review.php">Intern Applications</a>
                                </li>
								<?php if(@$_SESSION['InstitutionID']){ ?>
								<li class="submenu-item <?php if($title == "Host Institution Allocation Review"){ echo "active"; } ?>">
                                    <a href="host-review-ha.php">Host Institution Allocation Review</a>
                                </li>
								<?php } ?>
								<?php if(@$_SESSION['user_type'] == '1'){ ?>
                                <li class="submenu-item <?php if($title == "Mentor Applications"){ echo "active"; } ?>">
                                    <a href="mentors-review.php">Mentor Applications</a>
                                </li>
								<li class="submenu-item <?php if($title == "Institution Applications"){ echo "active"; } ?>">
                                    <a href="host-review.php">Institution Applications</a>
                                </li>
								<?php } ?>
								
                                
                            </ul>
                        </li>
						
						<?php }

						if(@$_SESSION['user_type'] == '1'){ 
						
						
						
						
						
						
						?>
						<li class="sidebar-item  <?php if($menu_item == "7"){ echo "active"; } ?> ">
                            <a href="manage-calls.php" class='sidebar-link '>
                                <i class="bi bi-stack <?php if($menu_item == "7"){ echo "active"; } ?>"></i>
                                <span>Manage Calls</span>
                            </a>
                            
                        </li>
						
						
						
                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack <?php if($menu_item == "6"){ echo "active"; } ?>"></i>
                                <span>Manage Components</span>
                            </a>
                            <ul class="submenu <?php if($menu_item == "6"){ echo "active"; } ?>">
							<li class="submenu-item <?php if($title == "Host Institutions"){ echo "active"; } ?>">
                                    <a href="institutions.php">Host Institutions</a>
                                </li>
                                <li class="submenu-item <?php if($title == "Page Headings"){ echo "active"; } ?>">
                                    <a href="headings.php">Page Headings</a>
                                </li>
								<li class="submenu-item <?php if($title == "Email Templates"){ echo "active"; } ?>">
                                    <a href="email-templates.php">Email Templates</a>
                                </li>
                                
                            </ul>
                        </li>
						<?php } ?>
                        <!--li class="sidebar-item  <?php if($menu_item == "9"){ echo "active"; } ?>">
                            <a href="faq.php" class='sidebar-link'>
                                <i class="bi bi-life-preserver"></i>
                                <span>LiveChat</span>
                            </a>
                        </li-->
						
						<li class="sidebar-item  <?php if($menu_item == "11"){ echo "active"; } ?>">
                            <a href="documentation.php" class='sidebar-link'>
                                <i class="bi bi-life-preserver"></i>
                                <span>Supporting Documents</span>
                            </a>
                        </li>
						
						<li class="sidebar-item  ">
                            <a href="mailto:DSI_HSRC_Internship.queries@hsrc.ac.za" class='sidebar-link'>
                                <i class="bi bi-envelope-fill"></i>
                                <span>Email Us</span>
                            </a>
                        </li>

                        

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <script src="assets/vendors/fontawesome/all.min.js"></script>