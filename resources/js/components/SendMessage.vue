<script>
export default {
    props: ['agent_id', 'agent_name'],

    data(){
        return{
            form:{
                message: '',
                agent_id: this.agent_id,
            },
            errors:{},
            success:{},
        }
    },

    methods: {
        sendMessage(){
            axios({
                method: 'POST',
                url: '/send-message',
                data:this.form,
            })
                .then((response) => {
                    this.form.message = '';
                    this.success = response.data;
                    console.log(response.data);
                }) .catch((error) => {
                this.errors = error.response.data.errors;
            })
        },
    },

    name: "SendMessage"
}
</script>

<template>
    <div>

        <div data-bs-toggle="modal" data-bs-target="#chatModal" class="btn-box">
            <button style="background-color: #2DBE6C; color: white;" type="button" class="btn ">
                Live Chat
            </button>

        </div>


        <div class="modal fade" id="chatModal" tabindex="-1" aria-labelledby="chatModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fs-1" id="chatModalLabel">Chat with {{agent_name}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form @submit.prevent="sendMessage()">
                        <div class="modal-body">
                                <div class="form-group">
                                    <textarea v-model="form.message" name="message" id="" rows="4" class="form-control" placeholder="Message"></textarea>
                                    <span class="text-success" v-if="success.message">
                                        {{success.message}}
                                    </span>
                                    <span class="text-danger" v-if="errors.message">
                                        {{errors.message[0]}}
                                    </span>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button style="background-color: #2DBE6C; color: white;" type="submit" class="btn">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
