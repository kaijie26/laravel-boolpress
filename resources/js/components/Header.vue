<template>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <!-- <a class="navbar-brand" href="#">Navbar</a> -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li v-for="(link, index) in menuLinks" :key="index" class="nav-item">
                            <router-link class="nav-link" :to="link.routeName">{{link.labelName}}</router-link>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </nav>

    </header>
    
</template>

<script>
export default {
    name:'Header',

    data(){
        return{
            menuLinks: [
                {
                    routeName: '/',
                    labelName: 'Home'
                },
                {
                    routeName: '/about',
                    labelName: 'About'
                },
                {
                    routeName: '/blog',
                    labelName: 'Blog'
                },
                {
                    routeName: '/contact',
                    labelName: 'Contact us'
                }

            ]
        }

    }
}
</script>

