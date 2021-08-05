<?php 

$query = "SELECT * FROM UserDisability 	
	WHERE UserID = '".$_SESSION['id']."'";
	$result = mysqli_query($conn, $query);
	$details = mysqli_fetch_array($result);
	
?>
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="/"><img src="assets/images/logo/logo.png" alt="Logo" srcset=""></a>
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
								<li class="submenu-item <?php if($title == "Attachments"){ echo "active"; } ?>">
                                    <a href="attachments.php">Attachments</a>
                                </li>
								<li class="submenu-item <?php if($title == "Contact Details"){ echo "active"; } ?>">
                                    <a href="contact-details.php">Contact Details</a>
                                </li>
								<li class="submenu-item <?php if($title == "Employment Details"){ echo "active"; } ?>">
                                    <a href="employment-details.php">Employment Details</a>
                                </li>
								<li class="submenu-item <?php if($title == "Language Proficiency"){ echo "active"; } ?>">
                                    <a href="language-proficiency.php">Language Proficiency</a>
                                </li>
								<li class="submenu-item <?php if($title == "Next of Kin"){ echo "active"; } ?>">
                                    <a href="guardian.php">Next of Kin</a>
                                </li>
								
								<li class="submenu-item <?php if($title == "Position Applied For"){ echo "active"; } ?>">
                                    <a href="position-applied-for.php">Position Applied For</a>
                                </li>
								<li class="submenu-item <?php if($title == "Personal Profile"){ echo "active"; } ?>">
                                    <a href="personal-profile.php">Personal Profile</a>
                                </li>
								<li class="submenu-item <?php if($title == "Qualifications"){ echo "active"; } ?>">
                                    <a href="qualification.php">Qualifications</a>
                                </li>
								<li class="submenu-item <?php if($title == "Registration Details"){ echo "active"; } ?>">
                                    <a href="user-registration.php">Registration Details</a>
                                </li>
								<li class="submenu-item <?php if($title == "References"){ echo "active"; } ?>">
                                    <a href="references.php">References</a>
                                </li>
                                
                            </ul>
                        </li>
						
						<li class="sidebar-item  has-sub ">
                            <a href="#" class='sidebar-link '>
                                <i class="bi bi-stack <?php if($menu_item == "4"){ echo "active"; } ?>"></i>
                                <span>My Applications</span>
                            </a>
                            <ul class="submenu <?php if($menu_item == "4"){ echo "active"; } ?>">
							
								<li class="submenu-item <?php if($title == "Create Application"){ echo "active"; } ?>">
                                    <a href="create-application.php">Create Application</a>
                                </li>
								
								<li class="submenu-item <?php if($title == "List of Applications"){ echo "active"; } ?>">
                                    <a href="list-applications.php">My Applications</a>
                                </li>
								
                            </ul>
                        </li>
						
						<li class="sidebar-item  has-sub ">
                            <a href="#" class='sidebar-link '>
                                <i class="bi bi-stack <?php if($menu_item == "7"){ echo "active"; } ?>"></i>
                                <span>My Progress Reports</span>
                            </a>
                            <ul class="submenu <?php if($menu_item == "7"){ echo "active"; } ?>">
							
								<li class="submenu-item <?php if($title == "Create Progress Report"){ echo "active"; } ?>">
                                    <a href="create-progress-report.php">Create Progress Report</a>
                                </li>
								
								<li class="submenu-item <?php if($title == "List of Progress Reports"){ echo "active"; } ?>">
                                    <a href="progress-reports.php">List of Progress Reports</a>
                                </li>
								
                            </ul>
                        </li>
						<?php if(@$_SESSION['user_type'] == '1'){ ?>
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
                                    <a href="list-host-applications.php">My Applications</a>
                                </li>
                                <!--li class="submenu-item <?php if($title == "Registration Details"){ echo "active"; } ?>">
                                    <a href="user-registration.php">Call Information Documents</a>
                                </li-->
								<!--li class="submenu-item <?php if($title == "Registration Details"){ echo "active"; } ?>">
                                    <a href="user-registration.php">Registration Details</a>
                                </li-->
								<li class="submenu-item <?php if($title == "Contact Details"){ echo "active"; } ?>">
                                    <a href="contact-details.php">Contact Details</a>
                                </li>
								<li class="submenu-item <?php if($title == "Host Institution"){ echo "active"; } ?>">
                                    <a href="host-institution.php">Host Institution Details</a>
                                </li>
								<li class="submenu-item <?php if($title == "Prospective Mentors and Required Intern Profile"){ echo "active"; } ?>">
                                    <a href="prospective-mentors-and-required-intern-profile.php">Prospective Mentors and Required Intern Profile</a>
                                </li>
								<li class="submenu-item <?php if($title == "Profile of Requested Interns"){ echo "active"; } ?>">
                                    <a href="profile-of-requested-interns.php">Profile of Requested Intern</a>
                                </li>
								<li class="submenu-item <?php if($title == "Prospective Mentors"){ echo "active"; } ?>">
                                    <a href="prospective-mentors.php">Prospective Mentors</a>
                                </li>
                                
                            </ul>
                        </li>
						
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
                                <li class="submenu-item ">
                                    <a href="#">Countries</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="#">Provices</a>
                                </li>
                                <li class="submenu-item <?php if($title == "Host Institutions"){ echo "active"; } ?>">
                                    <a href="institutions.php">Host Institutions</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="#">Languages</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="#">Titles</a>
                                </li>
								<li class="submenu-item ">
                                    <a href="#">Qualification Status</a>
                                </li>
								<li class="submenu-item ">
                                    <a href="#">Citizenship Status</a>
                                </li>
								<li class="submenu-item ">
                                    <a href="#">ID Types</a>
                                </li>
								<li class="submenu-item ">
                                    <a href="#">Race</a>
                                </li>
								<li class="submenu-item ">
                                    <a href="#">Gender</a>
                                </li>
								<li class="submenu-item ">
                                    <a href="#">Institution Categories</a>
                                </li>
								<li class="submenu-item ">
                                    <a href="#">Basic Available Resources</a>
                                </li>
								<li class="submenu-item ">
                                    <a href="#">Sector</a>
                                </li>
								<li class="submenu-item ">
                                    <a href="#">Career Profile Type</a>
                                </li>
								<li class="submenu-item ">
                                    <a href="#">Funding Period</a>
                                </li>
								<li class="submenu-item ">
                                    <a href="#">Discipline (of degree to be funded)</a>
                                </li>
								<li class="submenu-item ">
                                    <a href="#">Completion time for undergraduate degree</a>
                                </li>
								<li class="submenu-item ">
                                    <a href="#">Language Proficiency</a>
                                </li>
                            </ul>
                        </li>
						<?php } ?>
                        <li class="sidebar-item  ">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-life-preserver"></i>
                                <span>FAQ</span>
                            </a>
                        </li>

                        

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        