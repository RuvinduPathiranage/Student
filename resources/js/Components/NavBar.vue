<script>
import { router, usePage } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3'
export default {
    components: {
        Link
    },
    props:{
        title:String
    },
    setup(props) {
        return{
            route: window.route
        }
    }
}


</script>

<template>
    <div>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <Link class="navbar-brand" :href="route('dashboard')">dashboard</Link>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <Link class="nav-link active" :href="route('student')" aria-current="page">Student</Link>
                        </li>
                    </ul>
                    <!-- Authentication -->
                    <!-- <form id="frm-logout" action="" method="POST" style="display: none;">
                    
                        </form> -->
                    <span>
                        <Link :href="route('register')">Register</Link>
                    </span>
                </div>
            </div>
        </nav>

    </div>
</template>



<style lang="scss" scoped></style>