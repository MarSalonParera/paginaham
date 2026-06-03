(function () {
    const STORAGE_USERS = "usuarios";
    const STORAGE_SESSION = "usuario";
    const STORAGE_ACTIVE = "sessionActiva";

    function getStoredUsers() {
        const stored = localStorage.getItem(STORAGE_USERS);
        return stored ? JSON.parse(stored) : [];
    }

    function saveUsers(users) {
        localStorage.setItem(STORAGE_USERS, JSON.stringify(users));
    }

    function setSession(user) {
        localStorage.setItem(STORAGE_SESSION, JSON.stringify(user));
        localStorage.setItem(STORAGE_ACTIVE, "true");
    }

    window.registerUser = function (userData) {
        if (!userData || !userData.email) {
            return {
                success: false,
                message: "El correo electrónico es obligatorio.",
            };
        }

        const users = getStoredUsers();
        const existing = users.find((user) => user.email === userData.email);
        if (existing) {
            return {
                success: false,
                message: "Ya existe una cuenta con ese correo.",
            };
        }

        users.push(userData);
        saveUsers(users);
        setSession(userData);

        return { success: true };
    };

    window.loginUser = function (credentials) {
        if (!credentials || !credentials.email) {
            return { success: false, message: "El correo electrónico es obligatorio." };
        }

        const users = getStoredUsers();
        const user = users.find((item) => item.email === credentials.email);
        if (!user) {
            return { success: false, message: "Usuario no encontrado." };
        }

        setSession(user);
        return { success: true, user };
    };

    window.logoutUser = function () {
        localStorage.removeItem(STORAGE_SESSION);
        localStorage.removeItem(STORAGE_ACTIVE);
    };
})();