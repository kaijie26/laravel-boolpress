<template>
    <div class="container">
        <h2>Contattaci</h2>

        <div v-if="success" class="alert alert-info" role="alert">
            Grazie per averci contattato
        </div>
        <!-- Form -->
        <form @submit.prevent="sendMessage">
            <!-- User-Name -->
            <div class="mb-3">
                <label for="user-name" class="form-label">Nome</label>
                <input v-model="userName" type="text" class="form-control" id="user-name">
                <!-- Errore -->
                <div v-if="errors.name">
                    <div v-for="(error,index) in errors.name" :key="index" class="alert alert-danger" role="alert">
                       {{ error }}
                    </div>
                </div>
            </div>
            <!-- User-Email -->
            <div class="mb-3">
                <label for="user-email" class="form-label">Email</label>
                <input v-model="userEmail" type="email" class="form-control" id="user-email">
                <!-- Errore -->
                <div v-if="errors.name">
                    <div v-for="(error,index) in errors.email" :key="index" class="alert alert-danger" role="alert">
                       {{ error }}
                    </div>
                </div>
            </div>
            <!-- User-Message -->
            <div class="mb-3">
                <label for="user-message">Messaggio</label>
                <textarea v-model="userMessage" class="form-control" placeholder="Leave a message  here" id="user-message" rows="10"></textarea>
                <!-- Errore -->
                <div v-if="errors.name">
                    <div v-for="(error,index) in errors.message" :key="index" class="alert alert-danger" role="alert">
                       {{ error }}
                    </div>
                </div>
            </div>
            <!-- Btn -->
            <button :disabled="sending" type="submit" class="btn btn-primary">Submit</button>
        </form>
        
    </div>
    
</template>

<script>
export default {
    name: 'ContactPage',
    data(){
        return{
            userName: '',
            userEmail: '',
            userMessage: '',
            success: false,
            errors: {},
            sending: false,
        }
    },
    methods: {
        sendMessage(){
            this.sending = true;

           axios.post('/api/leads', {
                name: this.userName,
                email: this.userEmail,
                message: this.userMessage,
           })
           .then((response) => {

                if(response.data.success) {
                    this.success = true;

                    this.userName = '';
                    this.userEmail = '';
                    this.userMessage = '';
                    this.errors = '';

                }else{
                    this.errors = response.data.errors; 

                }

                this.sending = false
           }) 
        }
    }
}
</script>