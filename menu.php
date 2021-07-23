
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="index.php"><img src="assets/images/logo/logo.png" alt="Logo" srcset=""></a>
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
                            <a href="index.php" class='sidebar-link'>
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
							
								<li class="submenu-item <?php if($title == "Personal Profile"){ echo "active"; } ?>">
                                    <a href="personal-profile.php">Personal Profile</a>
                                </li>
								<li class="submenu-item <?php if($title == "Disability"){ echo "active"; } ?>">
                                    <a href="disability.php">Disability</a>
                                </li>
								<li class="submenu-item <?php if($title == "Registration Details"){ echo "active"; } ?>">
                                    <a href="user-registration.php">Registration Details</a>
                                </li>
								<li class="submenu-item <?php if($title == "Contact Details"){ echo "active"; } ?>">
                                    <a href="contact-details.php">Contact Details</a>
                                </li>
								<li class="submenu-item <?php if($title == "Parent / Guardian"){ echo "active"; } ?>">
                                    <a href="guardian.php">Parent / Guardian</a>
                                </li>
								<li class="submenu-item <?php if($title == "Language Proficiency"){ echo "active"; } ?>">
                                    <a href="language-proficiency.php">Language Proficiency</a>
                                </li>
								<li class="submenu-item <?php if($title == "Qualifications"){ echo "active"; } ?>">
                                    <a href="qualification.php">Qualifications</a>
                                </li>							
                                <li class="submenu-item <?php if($title == "Attachments"){ echo "active"; } ?>">
                                    <a href="attachments.php">Attachments</a>
                                </li>
								<li class="submenu-item <?php if($title == "Student Supervision Record"){ echo "active"; } ?>">
                                    <a href="student-supervision-record.php">Student Supervision Record</a>
                                </li>
								<li class="submenu-item <?php if($title == "Career Profile"){ echo "active"; } ?>">
                                    <a href="career-profile.php">Career Profile</a>
                                </li>
								<li class="submenu-item <?php if($title == "Absence from Research"){ echo "active"; } ?>">
                                    <a href="absence-from-research.php">Absence from Research</a>
                                </li>
                                <li class="submenu-item <?php if($title == "Research Expertise"){ echo "active"; } ?>">
                                    <a href="research-expertise.php">Research Expertise</a>
                                </li>
								<li class="submenu-item <?php if($title == "References"){ echo "active"; } ?>">
                                    <a href="references.php">References</a>
                                </li>
                                <li class="submenu-item <?php if($title == "Position Applied For"){ echo "active"; } ?>">
                                    <a href="position-applied-for.php">Position Applied For</a>
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
                                    <a href="list-applications.php">List of Applications</a>
                                </li>
								
                            </ul>
                        </li>
						
						<li class="sidebar-item  has-sub ">
                            <a href="#" class='sidebar-link '>
                                <i class="bi bi-stack <?php if($menu_item == "5"){ echo "active"; } ?>"></i>
                                <span>My Progress Reports</span>
                            </a>
                            <ul class="submenu <?php if($menu_item == "5"){ echo "active"; } ?>">
							
								<li class="submenu-item <?php if($title == "Create Progress Report"){ echo "active"; } ?>">
                                    <a href="create-progress-report.php">Create Progress Report</a>
                                </li>
								<li class="submenu-item <?php if($title == "List of Progress Reports"){ echo "active"; } ?>">
                                    <a href="progress-reports.php">List of Progress Reports</a>
                                </li>
								
                            </ul>
                        </li>
						
						<li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack <?php if($menu_item == "3"){ echo "active"; } ?>"></i>
                                <span>Manage Host Institution</span>
                            </a>
                            <ul class="submenu <?php if($menu_item == "3"){ echo "active"; } ?>">
                                <li class="submenu-item <?php if($title == "Registration Details"){ echo "active"; } ?>">
                                    <a href="user-registration.php">Call Information Documents</a>
                                </li>
								<li class="submenu-item <?php if($title == "Registration Details"){ echo "active"; } ?>">
                                    <a href="user-registration.php">Registration Details</a>
                                </li>
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
						
                      

                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack <?php if($menu_item == "6"){ echo "active"; } ?>"></i>
                                <span>Manage Components</span>
                            </a>
                            <ul class="submenu <?php if($menu_item == "6"){ echo "active"; } ?>"">
                                <li class="submenu-item ">
                                    <a href="extra-component-avatar.html">Countries</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="extra-component-sweetalert.html">Provices</a>
                                </li>
                                <li class="submenu-item <?php if($title == "Host Institutions"){ echo "active"; } ?>">
                                    <a href="institutions.php">Host Institutions</a>
                                </li>
								<li class="submenu-item <?php if($title == "Funding Opportunities"){ echo "active"; } ?>">
                                    <a href="funding-opportunities.php">Funding Opportunities</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="extra-component-rating.html">Languages</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="extra-component-divider.html">Titles</a>
                                </li>
								<li class="submenu-item ">
                                    <a href="extra-component-divider.html">Qualification Status</a>
                                </li>
								<li class="submenu-item ">
                                    <a href="extra-component-divider.html">Citizenship Status</a>
                                </li>
								<li class="submenu-item ">
                                    <a href="extra-component-divider.html">ID Types</a>
                                </li>
								<li class="submenu-item ">
                                    <a href="extra-component-divider.html">Race</a>
                                </li>
								<li class="submenu-item ">
                                    <a href="extra-component-divider.html">Gender</a>
                                </li>
								<li class="submenu-item ">
                                    <a href="extra-component-divider.html">Institution Categories</a>
                                </li>
								<li class="submenu-item ">
                                    <a href="extra-component-divider.html">Basic Available Resources</a>
                                </li>
								<li class="submenu-item ">
                                    <a href="extra-component-divider.html">Sector</a>
                                </li>
								<li class="submenu-item ">
                                    <a href="extra-component-divider.html">Career Profile Type</a>
                                </li>
								<li class="submenu-item ">
                                    <a href="extra-component-divider.html">Funding Period</a>
                                </li>
								<li class="submenu-item ">
                                    <a href="extra-component-divider.html">Discipline (of degree to be funded)</a>
                                </li>
								<li class="submenu-item ">
                                    <a href="extra-component-divider.html">Completion time for undergraduate degree</a>
                                </li>
								<li class="submenu-item ">
                                    <a href="extra-component-divider.html">Language Proficiency</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-life-preserver"></i>
                                <span>Documentation</span>
                            </a>
                        </li>

                        

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        