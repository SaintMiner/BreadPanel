import Register from '../../components/Authentication/Register.vue';
import Profile from '../../components/User/Profile.vue';
import store from '../../store';

import Invitation from '../../components/System/Invitation/Invitation.vue';
import Role from '../../components/System/Role/Role.vue';

import PermissionTest from '../../components/ParmissionTest.vue';

const routes = [
    {
        title: 'Profile',
        path: 'profile',
        component: Profile,
        icon: 'mdi-account-circle',
        permissions: [],
        authenticated: true
    },
    {
        title: 'Invitations',
        path: 'invitation',
        component: Invitation,
        icon: 'mdi-label',
        permissions: ['manage invitations'],
        authenticated: true
    },
    {
        title: 'Permission',
        path: 'permission',
        component: PermissionTest,
        icon: 'mdi-label',
        permissions: [],
        authenticated: false
    },
    {
        title: 'Role',
        path: 'role',
        component: Role,
        icon: 'mdi-label',
        permissions: [],
        authenticated: true
    }
];

export default routes;