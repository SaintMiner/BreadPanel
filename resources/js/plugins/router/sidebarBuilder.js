import routes from './routes';

const sidebar = routes.map(route => {
    return {
        title: route.title,
        path: route.path,
        icon: route.icon,
        authenticated: route.authenticated,
        permissions: route.permissions,
    }
});

export default sidebar;