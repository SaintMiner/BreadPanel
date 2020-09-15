import Profile from '../../components/User/Profile.vue';

import BreadBoard from '../../components/BreadBoard/BreadBoard.vue';

import Invitation from '../../components/System/Invitation/Invitation.vue';
import Role from '../../components/System/Role/Role.vue';
import User from '../../components/User/User.vue';

import PermissionTest from '../../components/ParmissionTest.vue';
/** EXAMPLE
    title: 'Profile', //used in sidebar 
    name: 'profile', //used in sidebar and router. Sidebar routes by name
    path: 'profile/:user_id?', //path can be customized
    icon: 'mdi-account-circle', //icon for sidebar
    component: Profile, //for router
    permissions: [], //for router & sidebar permission filtering
    authenticated: true, //TRUE - need auth
    blocked: true, //for router & sidebar blocked user filtering | TRUE - blocked users can access
    dontSidebar: true, //TRUE - dont show in sidebar
 */
const routes = [
    {
        title: 'BreadBoard',
        name: 'breadboard',
        path: 'breadboard',
        component: BreadBoard,
        icon: 'mdi-bread-slice',
        permissions: [],
        authenticated: true,
        blocked: true,
    },    
    {
        title: 'Profile',
        name: 'profile',
        path: 'profile/:user_id?',
        icon: 'mdi-account-circle',
        component: Profile,
        permissions: [],
        authenticated: true,
        blocked: true,
        // dontSidebar: true,
    },
    {
        title: 'Invitations',
        name: 'invitation',
        path: 'invitation',
        component: Invitation,
        icon: 'mdi-label',
        permissions: ['manage invitations'],
        authenticated: true,
        blocked: false,
    },
    {
        title: 'Permissions',
        name: 'permission',
        path: 'permission',
        component: PermissionTest,
        icon: 'mdi-label',
        permissions: [],
        authenticated: false,
        blocked: true,
    },
    {
        title: 'Roles',
        name: 'role',
        path: 'role',
        component: Role,
        icon: 'mdi-account-box-multiple',
        permissions: [],
        authenticated: true,
        blocked: false,
    },
    {
        title: 'Users',
        name: 'user',
        path: 'user',
        component: User,
        icon: 'mdi-account-multiple',
        permissions: [],
        authenticated: true,
        blocked: false,
    }
];

export default routes;