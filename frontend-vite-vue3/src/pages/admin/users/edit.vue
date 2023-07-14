<template>
  <form @submit.prevent="updateUsers()">
    <a-card title="Cap nhat tai khoan" style="widows: 100%">
      <div class="row">
        <div class="col-12 col-sm-4">
          <div class="row">
            <div class="col-12 d-flex justify-content-center mb-2">
              <a-avatar shape="square" :size="150">
                <template #icon>
                  <img src="../../../assets/vue.svg" alt="Avatar" />
                </template>
              </a-avatar>
            </div>

            <div class="col-12 d-flex justify-content-center">
              <a-button type="primary">
                <i class="fa-solid fa-plus me-2"></i>
                <span>Chon Anh</span>
              </a-button>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-8">
          <div class="row mb-2">
            <div class="col-12 col-sm-3 text-start text-sm-end">
              <label>
                <span class="text-danger me-1">*</span>
                <span
                  :class="{
                    'text-danger': errors.status_id,
                  }"
                  >Tinh Trang:</span
                >
              </label>
            </div>

            <div class="col-12 col-sm-5">
              <a-select
                show-search
                placeholder="Tinh trang"
                style="width: 100%"
                :options="users_status"
                :filter-option="filterOption"
                allow-clear
                v-model:value="status_id"
                :class="{
                  'select-danger': errors.status_id,
                }"
              >
              </a-select>
              <div class="w-100"></div>
              <small v-if="errors.status_id" class="text-danger">{{
                errors.status_id[0]
              }}</small>
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-12 col-sm-3 text-start text-sm-end">
              <label>
                <span class="text-danger me-1">*</span>
                <span
                  :class="{
                    'text-danger': errors.username,
                  }"
                  >Ten Tai khoan:</span
                >
              </label>
            </div>

            <div class="col-12 col-sm-5">
              <a-input
                placeholder="Ten Tai khoan"
                allow-clear
                v-model:value="username"
                :class="{
                  'input-danger': errors.username,
                }"
              />
              <div class="w-100"></div>
              <small v-if="errors.username" class="text-danger">{{
                errors.username[0]
              }}</small>
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-12 col-sm-3 text-start text-sm-end">
              <label>
                <span class="text-danger me-1">*</span>
                <span
                  :class="{
                    'text-danger': errors.name,
                  }"
                  >Ho va Ten:</span
                >
              </label>
            </div>

            <div class="col-12 col-sm-5">
              <a-input
                placeholder="Ho va Ten"
                allow-clear
                v-model:value="name"
                :class="{
                  'input-danger': errors.name,
                }"
              />
              <div class="w-100"></div>
              <small v-if="errors.name" class="text-danger">{{
                errors.name[0]
              }}</small>
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-12 col-sm-3 text-start text-sm-end">
              <label>
                <span class="text-danger me-1">*</span>
                <span
                  :class="{
                    'text-danger': errors.email,
                  }"
                  >Email:</span
                >
              </label>
            </div>

            <div class="col-12 col-sm-5">
              <a-input
                placeholder="Email"
                allow-clear
                v-model:value="email"
                :class="{
                  'input-danger': errors.email,
                }"
              />
              <div class="w-100"></div>
              <small v-if="errors.email" class="text-danger">{{
                errors.email[0]
              }}</small>
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-12 col-sm-3 text-start text-sm-end">
              <label>
                <span class="text-danger me-1">*</span>
                <span
                  :class="{
                    'text-danger': errors.department_id,
                  }"
                  >Phong Ban:</span
                >
              </label>
            </div>

            <div class="col-12 col-sm-5">
              <a-select
                show-search
                placeholder="Phong Ban"
                style="width: 80%"
                :options="departments"
                :filter-option="filterOption"
                allow-clear
                v-model:value="department_id"
                :class="{
                  'select-danger': errors.department_id,
                }"
              >
              </a-select>
              <div class="w-100"></div>
              <small v-if="errors.department_id" class="text-danger">{{
                errors.department_id[0]
              }}</small>
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-12 col-sm-3 text-start text-sm-end"></div>

            <div class="col-12 col-sm-5">
              <a-checkbox v-model:checked="change_password">
                Doi mat khau
              </a-checkbox>
            </div>
          </div>

          <div class="row mb-2" v-if="change_password == true">
            <div class="col-12 col-sm-3 text-start text-sm-end">
              <label>
                <span class="text-danger me-1">*</span>
                <span
                  :class="{
                    'text-danger': errors.password,
                  }"
                  >Mat Khau:</span
                >
              </label>
            </div>

            <div class="col-12 col-sm-5">
              <a-input-password
                placeholder="Mat Khau"
                allow-clear
                v-model:value="password"
                :class="{
                  'input-danger': errors.password,
                }"
              />
              <div class="w-100"></div>
              <small v-if="errors.password" class="text-danger">{{
                errors.password[0]
              }}</small>
            </div>
          </div>

          <div class="row mb-2" v-if="change_password == true">
            <div class="col-12 col-sm-3 text-start text-sm-end">
              <label>
                <span class="text-danger me-1">*</span>
                <span>Xac nhan Mat Khau:</span>
              </label>
            </div>

            <div class="col-12 col-sm-5">
              <a-input-password
                placeholder="Xac nhan Mat Khau"
                allow-clear
                v-model:value="password_confirmation"
              />
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-12 col-sm-3 text-start text-sm-end">
              <label>
                <span>Lan dang nhap gan day:</span>
              </label>
            </div>

            <div class="col-12 col-sm-5">
              <span>{{ login_at }}</span>
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-12 col-sm-3 text-start text-sm-end">
              <label>
                <span>Lan doi mat khau gan day:</span>
              </label>
            </div>

            <div class="col-12 col-sm-5">
              <span>{{ change_password_at }}</span>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12 d-grid d-sm-flex justify-content-sm-end mx-auto">
          <a-button class="me-0 me-sm-2 mb-2 mb-sm-0">
            <router-link :to="{ name: 'admin-users' }">
              <span>Huy</span>
            </router-link>
          </a-button>

          <a-button type="primary" html-type="submit">
            <span>Luu</span>
          </a-button>
        </div>
      </div>
    </a-card>
  </form>
</template>

<script>
import { defineComponent, ref, reactive, toRefs } from "vue";
import { useRouter } from "vue-router";
import { useRoute } from "vue-router";
import { message } from "ant-design-vue";
import { useMenu } from "../../../stores/use-menu";
import dayjs from "dayjs";
import axios from "axios";

export default defineComponent({
  setup() {
    useMenu().onSelectedKeys(["admin-users"]);

    const router = useRouter();
    const route = useRoute();
    const users_status = ref([]);
    const departments = ref([]);

    const users = reactive({
      username: "",
      name: "",
      email: "",
      password: "",
      password_confirmation: "",
      department_id: [],
      status_id: [],
      change_password: false,
      login_at: "",
      change_password_at: "",
    });

    const errors = ref({});

    const getUsersEdit = () => {
      console.log(`User dang truy xuat: ${route.params.id}`);

      axios
        .get(`http://localhost/api/users/edit/${route.params.id}`)
        .then((response) => {
          console.log(response);
          users.username = response.data.users.username;
          users.name = response.data.users.name;
          users.email = response.data.users.email;
          users.department_id = response.data.users.department_id;
          users.status_id = response.data.users.status_id;

          response.data.users.login_at
            ? (users.login_at = dayjs(response.data.users.login_at).format(
                "DD/MM/YYYY - HH:mm"
              ))
            : (users.login_at = "Chua co luot dang nhap");
          response.data.users.change_password_at
            ? (users.change_password_at = dayjs(
                response.data.users.change_password_at
              ).format("DD/MM/YYYY - HH:mm"))
            : (users.change_password_at = "Chua co luot doi mat khau");

          // users.login_at = response.data.users.login_at;
          // users.change_password_at = response.data.users.change_password_at;

          users_status.value = response.data.users_status;
          departments.value = response.data.departments;
        })
        .catch((error) => {
          console.log(error);
        });
    };

    const updateUsers = () => {
      axios
        .put(`http://localhost/api/users/${route.params.id}`, users)
        .then((response) => {
          if (response.status == 200) {
            message.success("Cap nhat thanh cong");
            router.push({ name: "admin-users" });
          }
        })
        .catch((error) => {
          errors.value = error.response.data.errors;
        });
    };

    const filterOption = (input, option) => {
      return option.label.toLowerCase().indexOf(input.toLowerCase()) >= 0;
    };

    getUsersEdit();

    return {
      users_status,
      departments,
      ...toRefs(users),
      errors,
      filterOption,
      updateUsers,
    };
  },
});
</script>

<style>
.select-danger {
  border: 1px solid red;
}

.input-danger {
  border-color: red;
}
</style>
