<template>
        <!-- Nav Main -->
        <nav class="nav">
            <div class="nav_wrapper">
                <span class="nav_close">
                    <i class="fas fa-window-close"></i>
                </span>
                <ul class="nav_list">
                    <li class="nav_item">
                        <router-link class="nav_link" to="/admin/home">  <!-- nav__active -->
                            <span class="nav_link--span--icon">
                                <i class="fas fa-home nav__link--icon"> </i>
                            </span>
                            <span class="nav_link--span--navname">
                                Home
                            </span>
                        </router-link>
                    </li>
                    <li class="nav_item">
                        <router-link to="/admin/about" class="nav_link ">
                            <span class="nav_link--span--icon">
                                <i class="fas fa-home nav__link--icon"> </i>
                            </span>
                            <span class="nav_link--span--navname">
                                About Us
                            </span>
                        </router-link>
                    </li>
                    <li class="nav_item">
                        <router-link class="nav_link " to="/admin/service">
                            <span class="nav_link--span--icon">
                                <i class="fas fa-home nav__link--icon"> </i>
                            </span>
                            <span class="nav_link--span--navname">
                                Services
                            </span>
                        </router-link>
                    </li>
                    <li class="nav_item">
                        <router-link to="/admin/skill" class="nav_link" >
                            <span class="nav_link--span--icon">
                                <i class="fas fa-home nav__link--icon"> </i>
                            </span>
                            <span class="nav_link--span--navname">
                                Skills
                            </span>
                        </router-link>
                    </li>

                    <li class="nav_item">
                        <router-link to="/admin/education" class="nav_link " >
                            <span class="nav_link--span--icon">
                                <i class="fas fa-home nav__link--icon"> </i>
                            </span>
                            <span class="nav_link--span--navname">
                                Education
                            </span>
                        </router-link>
                    </li>
                    <li class="nav_item">
                        <router-link to="/admin/experience" class="nav_link ">
                            <span class="nav_link--span--icon">
                                <i class="fas fa-home nav__link--icon"> </i>
                            </span>
                            <span class="nav_link--span--navname">
                                Experiences
                            </span>
                        </router-link>
                    </li>
                    <li class="nav_item">
                        <a class="nav_link " href="project.html">
                            <span class="nav_link--span--icon">
                                <i class="fas fa-home nav__link--icon"> </i>
                            </span>
                            <span class="nav_link--span--navname">
                                Projects
                            </span>
                        </a>
                    </li>
                    <li class="nav_item">
                        <a class="nav_link " href="#">
                            <span class="nav_link--span--icon">
                                <i class="fas fa-home nav__link--icon"> </i>
                            </span>
                            <span class="nav_link--span--navname">
                                Testimonial
                            </span>
                        </a>
                    </li>
                    <li class="nav_item">
                        <a class="nav_link " href="#">
                            <span class="nav_link--span--icon">
                                <i class="fas fa-home nav__link--icon"> </i>
                            </span>
                            <span class="nav_link--span--navname">
                                Messages
                            </span>
                        </a>
                    </li>
                    <li class="nav_item">
                        <a class="nav_link " href="#">
                            <span class="nav_link--span--icon">
                                <i class="fas fa-home nav__link--icon"> </i>
                            </span>
                            <span class="nav_link--span--navname">
                                Users
                            </span>
                        </a>
                    </li>
                    <li class="nav_item">
                        <a class="nav_link " href="#">
                            <span class="nav_link--span--icon">
                                <i class="fas fa-home nav__link--icon"> </i>
                            </span>
                            <span class="nav_link--span--navname">
                                Setting
                            </span>
                        </a>
                    </li>

                </ul>
            </div>
        </nav>
        <!-- End Nav Main -->
</template>
