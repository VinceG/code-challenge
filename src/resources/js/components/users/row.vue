<template>
    <tr>
        <td>{{ user.id }}</td>
        <td>
            <avatar :avatar="user.avatar" />
        </td>
        <td>{{ user.name }}</td>
        <td>{{ user.email }}</td>
    </tr>
</template>

<script>
import Avatar from "./avatar";
export default {
    components: {
        Avatar
    },
    props: {
        user: {
            type: Object,
            required: true
        }
    }
}
</script>
