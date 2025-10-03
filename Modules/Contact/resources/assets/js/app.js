// Modules/YourModuleName/Resources/assets/js/app.js
import { createApp } from "vue/dist/vue.esm-bundler";
import ExampleComponent from "./components/ExampleComponent.vue";
import Index from "./components/Contacts/Index.vue";

const app = createApp({});

// app.component("example-component", ExampleComponent);
app.component("contacts-component", Index);

app.mount("#app");
