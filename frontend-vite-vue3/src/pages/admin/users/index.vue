<template>
  <a-card title="Tai Khoan" style="widows: 100%">
    <div class="row mb-3">
      <div class="col-12 d-flex justify-content-end">
        <a-button type="primary">
          <router-link :to="{ name: 'admin-users-create' }">
            <i class="fa-solid fa-plus"></i>
          </router-link>
        </a-button>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <a-table :dataSource="users" :columns="columns" :scroll="{ x: 576 }">
          <template #bodyCell="{ column, index, record }">
            <template v-if="column.key === 'index'">
              <span>{{ index + 1 }}</span>
            </template>

            <template v-if="column.key === 'status'">
              <span v-if="record.status_id === 1" class="text-primary">{{
                record.status
              }}</span>
              <span v-else-if="record.status_id === 2" class="text-danger">{{
                record.status
              }}</span>
            </template>

            <template v-if="column.key === 'action'">
              <router-link
                :to="{ name: 'admin-users-edit', params: { id: record.id } }"
              >
                <a-button type="primary">
                  <i class="fa-solid fa-pen-to-square"></i>
                </a-button>
              </router-link>
            </template>
          </template>
        </a-table>
      </div>
    </div>
  </a-card>
</template>

<script>
import { defineComponent, ref } from "vue";
import { useMenu } from "../../../stores/use-menu";

export default defineComponent({
  setup() {
    useMenu().onSelectedKeys(["admin-users"]);

    const users = ref([]);
    const columns = [
      {
        title: "#",
        key: "index",
      },
      {
        title: "Avatar",
        dataIndex: "avatar",
        key: "avatar",
      },
      {
        title: "Tai Khoan",
        dataIndex: "username",
        key: "username",
      },
      {
        title: "Ho Ten",
        dataIndex: "name",
        key: "name",
      },
      {
        title: "Phong Ban",
        dataIndex: "department",
        key: "department",
        responsive: ["sm"],
      },
      {
        title: "Vai Tro",
        dataIndex: "role",
        key: "role",
      },
      {
        title: "Tinh Trang",
        dataIndex: "status",
        key: "status",
      },
      {
        title: "Cong Cu",
        key: "action",
        fixed: "right",
      },
    ];

    const getUsers = () => {
      axios
        .get("http://localhost/api/users")
        .then(function (response) {
          // console.log(response);
          users.value = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    };
    getUsers();

    return {
      users,
      columns,
    };
  },
});
</script>
