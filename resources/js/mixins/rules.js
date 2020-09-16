export default {
    data() {
        return {
            rules: {
                specialChars: value => /[^A-Za-z0-9]+/.test(value) || 'Requires special chars',
                excludeSpecialChars: value => !/[^A-Za-z0-9\-\_]+/.test(value) || 'Must contain only letters and numbers!',
                required: value => !!value || 'Required.',
                counter: value => !!value ? value.length <= 255 || 'Max 255 characters' : true,
                minimal: value => !!value ? value.length >= 4 || 'Min 4 characters' : true,
                password: value => {
                    const pattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/;
                    return pattern.test(value) || 'Password is too weak';
                }              
            }
        }
    }
  };