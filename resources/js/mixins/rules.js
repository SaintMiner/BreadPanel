export default {
    data() {
        return {
            rules: {
                required: value => !!value || 'Required.',
                counter: value => !!value ? value.length <= 255 || 'Max 255 characters' : true,
                password: value => {
                    const pattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/;
                    return pattern.test(value) || 'Password is too weak';
                }              
            }
        }
    }
  };