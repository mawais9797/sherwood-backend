<?php $admin_page = request()->segment(2); ?>
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{ url('admin/dashboard') }}" class="text-nowrap logo-img">
                <img src="{{ get_site_image_src('images', $site_settings->site_logo) }}" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a class="sidebar-link {{ $admin_page == 'dashboard' ? 'active' : '' }}"
                        href="{{ url('admin/dashboard') }}" aria-expanded="false">
                        <iconify-icon icon="solar:widget-add-line-duotone"></iconify-icon>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li>
                    <span class="sidebar-divider lg"></span>
                </li>
                <li class="nav-small-cap">
                    <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
                    <span class="hide-menu">Site Settings</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ $admin_page == 'site_settings' ? 'active' : '' }}"
                        href="{{ url('admin/site_settings') }}" aria-expanded="false">
                        <iconify-icon icon="octicon:gear-24"></iconify-icon>
                        <span class="hide-menu">Site Settings</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link {{ $admin_page == 'contact' ? 'active' : '' }}"
                        href="{{ url('admin/contact') }}" aria-expanded="false">
                        <iconify-icon icon="tabler:message-user"></iconify-icon>
                        <span class="hide-menu">Contact Messages</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link {{ $admin_page == 'subscribers' ? 'active' : '' }}"
                        href="{{ url('admin/subscribers') }}" aria-expanded="false">
                        <iconify-icon icon="jam:newsletter"></iconify-icon>
                        <span class="hide-menu">Subscribers</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link {{ $admin_page == 'change-password' ? 'active' : '' }}"
                        href="{{ url('admin/change-password') }}" aria-expanded="false">
                        <iconify-icon icon="teenyicons:password-outline"></iconify-icon>
                        <span class="hide-menu">Change Password</span>
                    </a>
                </li>
                <li>
                    <span class="sidebar-divider lg"></span>
                </li>
                <li class="nav-small-cap">
                    <iconify-icon icon="fluent-mdl2:content-feed"></iconify-icon>
                    <span class="hide-menu">Site Content</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ $admin_page == 'sitecontent' ? 'active' : '' }}"
                        href="{{ url('admin/sitecontent') }}" aria-expanded="false">
                        <iconify-icon icon="oui:pages-select"></iconify-icon>
                        <span class="hide-menu">Website Pages</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow {{ $admin_page == 'projects' || $admin_page == 'project_categories' ? 'active' : '' }}"
                        href="javascript:void(0)" aria-expanded="false">
                        <iconify-icon icon="mdi:briefcase-outline"></iconify-icon>

                        <span class="hide-menu">Projects </span>
                    </a>
                    <ul aria-expanded="false"
                        class="collapse first-level {{ $admin_page == 'projects' || $admin_page == 'project_categories' ? 'in' : '' }}">

                        <li class="sidebar-item">
                            <a class="sidebar-link {{ $admin_page == 'projects' ? 'active' : '' }}"
                                href="{{ url('admin/projects') }}">
                                <span class="icon-small"></span>Projects
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link {{ $admin_page == 'project_categories' ? 'active' : '' }}"
                                href="{{ url('admin/project_categories') }}">
                                <span class="icon-small"></span>Project
                                Categories
                            </a>
                        </li>


                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ $admin_page == 'events' ? 'active' : '' }}"
                        href="{{ url('/admin/sherwoodcontroller/events') }}" aria-expanded="false">
                        <iconify-icon icon="carbon:category"></iconify-icon>
                        <span class="hide-menu">Events Sherwood</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link {{ $admin_page == 'sherwoodtestimonials' ? 'active' : '' }}"
                        href="{{ url('admin/sherwoodtestimonials') }}" aria-expanded="false">
                        <iconify-icon icon="carbon:category"></iconify-icon>
                        <span class="hide-menu">Testimonials Sherwood</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link {{ $admin_page == 'gallery' ? 'active' : '' }}"
                        href="{{ url('admin/gallery') }}" aria-expanded="false">
                        <iconify-icon icon="carbon:category"></iconify-icon>
                        <span class="hide-menu">Gallery Sherwood</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link {{ $admin_page == 'services' ? 'active' : '' }}"
                        href="{{ url('admin/services') }}" aria-expanded="false">
                        <iconify-icon icon="carbon:category"></iconify-icon>
                        <span class="hide-menu">Services</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link {{ $admin_page == 'impact' ? 'active' : '' }}"
                        href="{{ url('admin/impact') }}" aria-expanded="false">
                        <iconify-icon icon="carbon:category"></iconify-icon>
                        <span class="hide-menu">Strategic Impact
                        </span>
                    </a>
                </li>



                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow {{ $admin_page == 'case_study' || $admin_page == 'case_study_categories' ? 'active' : '' }}"
                        href="javascript:void(0)" aria-expanded="false">
                        <iconify-icon icon="mdi:chart-box-outline"></iconify-icon>
                        <span class="hide-menu">Case Studies</span>
                    </a>
                    <ul aria-expanded="false"
                        class="collapse first-level {{ $admin_page == 'case_study' || $admin_page == 'case_study_categories' ? 'in' : '' }}">


                        <li class="sidebar-item">
                            <a class="sidebar-link {{ $admin_page == 'case_study' ? 'active' : '' }}"
                                href="{{ url('admin/case_study') }}">
                                <span class="icon-small"></span>Case Studies
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link {{ $admin_page == 'case_study_categories' ? 'active' : '' }}"
                                href="{{ url('admin/case_study_categories') }}">
                                <span class="icon-small"></span>Case Study Categories

                            </a>
                        </li>

                    </ul>
                </li>



                <li class="sidebar-item">
                    <a class="sidebar-link {{ $admin_page == 'testimonials' ? 'active' : '' }}"
                        href="{{ url('admin/testimonials') }}" aria-expanded="false">
                        <iconify-icon icon="dashicons:testimonial"></iconify-icon>
                        <span class="hide-menu">Testimonials</span>
                    </a>
                </li>

            </ul>

        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
