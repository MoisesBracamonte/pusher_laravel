
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
//window.Vue = require('vue');
import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('contactlist-component', require('./components/ContactListComponent.vue'));
Vue.component('sidelist-component', require('./components/SideListComponent.vue'));
Vue.component('conversacion-component', require('./components/ConversacionComponent.vue'));
Vue.component('messenger-component', require('./components/MessengerComponent.vue'));
Vue.component('profile-component', require('./components/ProfileComponent.vue'));

// Crear Store Vuex
const store = new Vuex.Store({
    state: {
        messages:[],
        conversations: [],
        myfilter:'',
        selectConversation:null,
        user:null
    },
    /* Las mutaciones son para pasar valores a nuestro estado*/
    mutations:{
        // Obtengo la información del usuario
        getUser(state,user){
            state.user = user 
        },
        // Acutalizar el listado de los mensajes
        newMessagesList(state,messages){
            state.messages = messages
        },
        /* Selecciona una conversacion */
        selectedConversation(state,conversation){
            state.selectConversation = conversation
        },
        /*obtiene los valores de la busqueda de usuario*/
        newFilter(state,newValue){
            state.myfilter = newValue
        },
        /* Agrega la lista de conversaciones*/
        getListConversations(state,conversations){
            state.conversations = conversations
        },
        /* Agregar un nuevo mensaje a la app*/
        addMessage(state, message) {
            let conversation = state.conversations.find(element => {
                if (element.contact_id == message.from_id) {
                    return element
                } else if (element.contact_id == message.to_id) {
                    return element
                }
            });
            let author = state.user.id === message.from_id ? 'Tú' : conversation.contact_name
            conversation.last_message = `${author} : ${message.content}`;
            conversation.last_time = message.created_at;
            if (state.selectConversation.contact_id == message.from_id) {
                state.messages.push(message)
            } else if (state.selectConversation.contact_id == message.to_id) {
                state.messages.push(message)
            }
        },
    },
    /* A travez de las acciones podemos  obtener data que necesitamos llamar a travez de una api*/
    actions:{
        /*Obtengo todo los mensajes*/
        getMessages:function(context,conversation) {
            axios.get(`/api/messages?contact_id=${conversation.contact_id}`)
                .then(response => {
                    context.commit('newMessagesList', response.data);
                    context.commit('selectedConversation', conversation)
                }).catch(error => {
                    console.log(error);
                })
        },
        /*Obtengo todas las conversaciones*/
        getConversation:function(context) {
            axios.get(`/api/conversations`)
                .then(response => {
                    context.commit('getListConversations',response.data)
                    context.conversations = response.data
                }).catch(error => {
                    console.log(error);
                })
        },
        /*Enviamos un nuevo mensaje*/
        postMessage(context,myForm) {
            let formData = new FormData(myForm);
            formData.append('to_id', context.state.selectConversation.contact_id );
            axios.post(`/api/messages`, formData)
                .then(response => {
                    if (response.statusText == 'OK') {
                        response.data.written_by_me = true;
                        this.$store.commit('addMessage', response.data)
                    }
                }).catch(error => {
                    console.log(error);
                })
        },


    },
    /*Con getters  podemos modificar de forma computada un estado de la app*/
    getters:{
        conversationsFilter: function (state) {
            return state.conversations.filter((conversation) => conversation.contact_name.includes(state.myfilter))
        },
    }
});
const app = new Vue({
    el: '#app',
    store:store
});
