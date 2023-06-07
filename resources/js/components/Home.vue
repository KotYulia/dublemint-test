<template>
    <div class="container my-5 home-block">
        <div>
            <h2>Home page</h2>
        </div>
        <div class="d-flex">
            <div class="me-3">
                <input
                    type="text"
                    id="myInput"
                    :value="copyTextInput"
                    style="display:none;"
                    ref="copyInput"
                />
                <b-button v-clipboard:copy="current_url" @click="copy" class="btn btn-secondary">Copy link</b-button>
            </div>
            <div class="me-3">
                <b-button @click="generate" class="btn btn-success mb-3">Generate new link</b-button>
                <p id="new-personal-link"></p>
            </div>
            <div>
                <b-button @click="deactivate" class="btn btn-danger">Deactivate link</b-button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <b-button @click="play" class="btn btn-dark mb-3">I'm feeling lucky</b-button>
                <p id="game-result"></p>
            </div>
        </div>


        <div>
            <b-button @click="get_results" class="btn btn-info mb-3">History</b-button>
            <ul id="last-results">
                <li v-for="result in results" :key="result.id">
                    {{ result.message }} {{ result.amount }}
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    name: "Home",

    data() {
        return {
            personal_link : window.location.pathname,
            current_url : window.location.href,
            results : null
        }
    },

    methods : {
        copy : function(){
            alert("Copied your personal link: " + this.current_url);
        },
        generate : function(){
            axios.get('/api/generate', {
                params: {
                    personal_link: this.personal_link
                }})
                .then(( response ) => {
                    const attr = document.getElementById("new-personal-link");
                    attr.innerHTML = response.data.message;
                })
        },
        deactivate : function(){
            axios.get('/api/deactivate', {
                params: {
                    personal_link: this.personal_link
                }})
                .then(response => {
                this.$router.push("/")

                }).catch(error => {
                    location.reload();
                });
        },
        play : function(){
            axios.get('/api/play', {
                params: {
                    personal_link: this.personal_link
                }})
                .then(( response ) => {
                    const attr = document.getElementById("game-result");
                    attr.innerHTML = response.data.message;
                })
        },
        get_results : function(){
            axios.get('/api/history', {
                params: {
                    personal_link: this.personal_link
                }})
                .then(( response ) => {
                    console.log(response.data);
                    this.results = response.data;
                })
        },
    }

}
</script>

<style scoped>

</style>
