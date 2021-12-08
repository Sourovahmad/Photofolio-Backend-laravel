import React from 'react';

const Profile = () => {
    return (
        <div>
            <h2> This is profile</h2>
        </div>
    );
};

export default Profile;

if (document.getElementById('profile')) {
    ReactDOM.render(<Profile />, document.getElementById('profile'));
}
