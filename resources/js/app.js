import './bootstrap';

import { createApp } from "vue";

const app = createApp();

import Modal from "./components/Modals/Modal.vue";
import FormModal from "./components/Modals/FormModal.vue";
import LogoutForm from "./components/Layout/LogoutForm.vue";
import EventButton from "./components/Layout/EventButton.vue";
import ApplicationLogo from "./components/Layout/ApplicationLogo.vue";
import DropdownLink from "./components/Layout/DropdownLink.vue";
import Navigation from "./components/Layout/Navigation.vue";
import TagsModal from "./components/Modals/TagsModal.vue";

app.component('modal', Modal);
app.component('form-modal', FormModal);
app.component('logout-form', LogoutForm);
app.component('event-button', EventButton);
app.component('application-logo', ApplicationLogo);
app.component('dropdown-link', DropdownLink);
app.component('navigation', Navigation);
app.component('tags-modal', TagsModal)


app.config.devtools = true;
app.mount('#app');
