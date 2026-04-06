<template>
    <aside>
        <nav>
            <div class="nav-wrapper">
                <span class="nav__close">
                    <i class="fas fa-window-close"></i>
                </span>
                <div class="nav-list">
                    <ul>
                        <li>
                            <router-link to="/admin/dashboard">
                                <span><i class="fas fa-home"> </i></span>
                                <span>Home</span>
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/admin/abouts">
                                <span><i class="fas fa-home"> </i></span>
                                <span>About Me</span>
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/admin/services">
                                <span><i class="fas fa-home"> </i></span>
                                <span>Services</span>
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/admin/skills">
                                <span><i class="fas fa-home"> </i></span>
                                <span>Skills</span>
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/admin/educations">
                                <span><i class="fas fa-home"> </i></span>
                                <span>Educations</span>
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/admin/experiences">
                                <span><i class="fas fa-home"> </i></span>
                                <span>Experiences</span>
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/admin/projects">
                                <span><i class="fas fa-home"> </i></span>
                                <span>Projects</span>
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/admin/testimonials">
                                <span><i class="fas fa-home"> </i></span>
                                <span>Testimonials</span>
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/admin/messages">
                                <span><i class="fas fa-home"> </i></span>
                                <span>Messages</span>
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/admin/users">
                                <span><i class="fas fa-home"> </i></span>
                                <span>Users</span>
                            </router-link>
                        </li>
                    </ul>
                </div>
                <div class="nav-list">
                    <ul>
                        <li>
                            <a href="setting.html">
                                <span><i class="fas fa-cog"> </i></span>
                                <span>Settings</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </aside>
</template>
<style scoped>
* {
    color: #000;
}
</style>
