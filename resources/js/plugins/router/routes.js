import Profile from '../../components/User/Profile.vue';

import BreadBoard from '../../components/BreadBoard/BreadBoard.vue';

import Invitation from '../../components/System/Invitation/Invitation.vue';
import Role from '../../components/System/Role/Role.vue';
import User from '../../components/User/User.vue';

import PermissionTest from '../../components/ParmissionTest.vue';

const routes = [
    {
        title: 'BreadBoard',
        path: 'breadboard',
        component: BreadBoard,
        icon: 'mdi-bread-slice',
        permissions: [],
        authenticated: true,
        blocked: true,
    },
    {
        title: 'Profile',
        path: 'profile',
        component: Profile,
        icon: 'mdi-account-circle',
        permissions: [],
        authenticated: true,
        blocked: true,
    },
    {
        title: 'Invitations',
        path: 'invitation',
        component: Invitation,
        icon: 'mdi-label',
        permissions: ['manage invitations'],
        authenticated: true,
        blocked: false,
    },
    {
        title: 'Permissions',
        path: 'permission',
        component: PermissionTest,
        icon: 'mdi-label',
        permissions: [],
        authenticated: false,
        blocked: true,
    },
    {
        title: 'Roles',
        path: 'role',
        component: Role,
        icon: 'mdi-label',
        permissions: [],
        authenticated: true,
        blocked: false,
    },
    {
        title: 'Users',
        path: 'user',
        component: User,
        icon: 'mdi-label',
        permissions: [],
        authenticated: true,
        blocked: false,
    }
];

export default routes;