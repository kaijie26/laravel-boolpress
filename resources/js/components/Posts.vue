<template>
    <div>
        <div class="container">
            <h2>Lista dei Posts</h2>
            <!-- Posts -->
            <div class="row row-cols-3">
                <div v-for="singlePost in posts" :key="singlePost.id" class="col mt-3">
                   <PostDetails :post="singlePost" />

                </div>

            </div>

            <!--Nav-Pagination  -->
            <nav>
                <ul class="pagination mt-3">
                    <!-- Previous-Button -->
                    <li class="page-item" :class="{'disabled' : currentPagination == 1 }">
                        <a @click.prevent="getPosts(currentPagination -1)" class="page-link" href="#">Previous</a>
                    </li>
                    
                    <!-- Page Number -->
                    <li v-for="paginationNumb in lastPagination" :key="paginationNumb" :class="{'active' : paginationNumb == currentPagination }" class="page-item">
                        <a @click.prevent="getPosts(paginationNumb)" class="page-link" href="#">{{paginationNumb}}</a>
                    </li>

                    <!-- Next-Button -->
                    <li class="page-item" :class="{'disabled' : currentPagination == lastPagination }" >
                        <a @click.prevent="getPosts(currentPagination +1)" class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>

        </div>
        
    </div>
    
</template>

<script>
import PostDetails from "./PostDetails.vue";
export default {
    name: 'Posts',
    components: {
        PostDetails,
    },

    data(){
        return{
            posts:[],
            currentPagination: 1,
            lastPagination: null


        }
    },

    methods: {
        getPosts(pageNumber){
            axios.get('/api/posts', {
                params: {
                    page: pageNumber,

                }
            })
            .then((response)=>{
                this.posts = response.data.results.data;
                this.currentPagination = response.data.results.current_page
                this.lastPagination = response.data.results.last_page
                
            })

        }



    }, 

    mounted(){
        this.getPosts(1);
        

    }
}
</script>