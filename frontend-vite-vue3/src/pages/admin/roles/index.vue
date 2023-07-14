<template>Day la trang quan ly Roles</template>

<script>
import { useMenu } from "../../../stores/use-menu";

export default {
  setup() {
    useMenu().onSelectedKeys(["admin-roles"]);
  },
};
</script>
