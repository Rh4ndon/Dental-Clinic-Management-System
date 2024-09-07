import { createContext, useContext, useState, useEffect } from 'react';
import { Platform } from 'react-native';
import AsyncStorage from '@react-native-async-storage/async-storage';

export const GlobalContext = createContext();

const GlobalProvider = ({ children }) => {
  const [isLoggedIn, setIsLoggedIn] = useState(false);
  const [user, setUser] = useState(null);
  const [isLoading, setIsLoading] = useState(true);

  const fetchUserData = async () => {
    try {
      let storedUser;
      if (Platform.OS === 'web') {
        storedUser = localStorage.getItem('user');
      } else {
        storedUser = await AsyncStorage.getItem('user');
      }
      if (storedUser) {
        const parsedUser = JSON.parse(storedUser);
        return parsedUser;
      }
    } catch (error) {
      console.error('Error fetching user data:', error);
    }
  };

  const rehydrate = async () => {
    const userData = await fetchUserData();
    if (userData) {
      setUser(userData);
      setIsLoggedIn(true);
    }
    setIsLoading(false);
  };

  useEffect(() => {
    rehydrate();
  }, []);

  useEffect(() => {
    if (user) {
      try {
        if (Platform.OS === 'web') {
          localStorage.setItem('user', JSON.stringify(user));
        } else {
          AsyncStorage.setItem('user', JSON.stringify(user));
        }
      } catch (error) {
        console.error('Error setting user:', error);
      }
    }
  }, [user]);

  const login = (userData) => {
    setUser(userData);
    setIsLoggedIn(true);
  };

  const refreshUser = async () => {
    await rehydrate();
  };

  const logout = () => {
    setUser(null);
    setIsLoggedIn(false);
    try {
      if (Platform.OS === 'web') {
        localStorage.removeItem('user');
      } else {
        AsyncStorage.removeItem('user');
      }
    } catch (error) {
      console.error('Error removing user:', error);
    }
  };

  return (
    <GlobalContext.Provider value={{ isLoggedIn, user, isLoading, login, logout, refreshUser }}>
      {children}
    </GlobalContext.Provider>
  );
};

export default GlobalProvider;