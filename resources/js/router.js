import Vue from 'vue';
import VueRouter from "vue-router";
import ExampleComponent from "./components/ExampleComponent";
import ContactsCreate from "./components/views/ContactsCreate";
import ContactsShow from "./components/views/ContactsShow";
import ContactsEdit from "./components/views/ContactsEdit";
import ContactsIndex from "./components/views/ContactsIndex";
import BirthdaysIndex from "./components/views/BirthdaysIndex";
import Logout from "./Actions/Logout";

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        {
            path: '/', component: ExampleComponent,
            meta: { title: 'Welcome' }
        }, {
            path: '/contacts', component: ContactsIndex,
            meta: { title: 'Contacts' }
        }, {
            path: '/contacts/create', component: ContactsCreate,
            meta: { title: 'Add New Contact' }
        }, {
            path: '/contacts/:id', component: ContactsShow,
            meta: { title: 'Details for Contact' }
        }, {
            path: '/contacts/:id/edit', component: ContactsEdit,
            meta: { title: 'Edit Contact' }
        }, {
            path: '/birthdays', component: BirthdaysIndex,
            meta: { title: 'This Month\'s Birthdays' }
        }, {
            path: '/logout', component: Logout,
        }
    ],
    mode: 'history',
})
