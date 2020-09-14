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
console.log(sidebar);
export default sidebar;