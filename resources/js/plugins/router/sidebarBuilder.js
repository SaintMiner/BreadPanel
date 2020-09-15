import routes from './routes';

const sidebar = routes.filter(route => !route.dontSidebar).map(route => {
    return {
        title: route.title,
        name: route.name,
        path: route.path,
        icon: route.icon,
        authenticated: route.authenticated,
        permissions: route.permissions,
        blocked: route.blocked,
    }
});

export default sidebar;