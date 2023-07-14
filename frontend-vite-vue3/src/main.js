import { createApp } from "vue";
import { createPinia } from "pinia";
import router from "./router/index";
import axios from "axios";
window.axios = axios;

import {
  Checkbox,
  Input,
  Select,
  Avatar,
  Table,
  Card,
  Menu,
  List,
  Drawer,
  Button,
  message,
} from "ant-design-vue";

import App from "./App.vue";

import "./static/fontawesome/css/all.min.css"; //Cach 1

// Cach 2
import { library } from "@fortawesome/fontawesome-svg-core";

// import specific icons
import { fas } from "@fortawesome/free-solid-svg-icons";
import { fab } from "@fortawesome/free-brands-svg-icons";
import { far } from "@fortawesome/free-regular-svg-icons";
// import font awesome icon component
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
// add icons to the library
library.add(fas, fab, far);
// End cach 2

import "ant-design-vue/dist/antd.css";
import "bootstrap/dist/css/bootstrap-grid.min.css";
import "bootstrap/dist/css/bootstrap-utilities.min.css";

const app = createApp(App);
app.component("font-awesome-icon", FontAwesomeIcon);
app.use(createPinia());
app.use(router);
app.use(Checkbox);
app.use(Input);
app.use(Select);
app.use(Avatar);
app.use(Table);
app.use(Card);
app.use(Menu);
app.use(Button);
app.use(Drawer);
app.use(List);
app.mount("#app");

app.config.globalProperties.$message = message;
