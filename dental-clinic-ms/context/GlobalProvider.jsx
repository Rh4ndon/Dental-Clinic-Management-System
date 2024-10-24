import { createContext, useContext, useState, useEffect } from 'react';
import { Platform } from 'react-native';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { getDentists, getAppointments } from '../lib/PhpRequest';

export const GlobalContext = createContext();

const GlobalProvider = ({ children }) => {
  const [isLoggedIn, setIsLoggedIn] = useState(false);
  const [user, setUser] = useState(null);
  const [code, setCode] = useState(null);
  const [dentist, setDentist] = useState(null);
  const [appointments, setAppointments] = useState(null);
  const [isLoading, setIsLoading] = useState(true);

  //For User
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

  const refreshUser = async () => {
    await rehydrate();
  };

  //For Code
  const fetchCodeData = async () => {
    try {
      let storedCode;
      if (Platform.OS === 'web') {
        storedCode = localStorage.getItem('code');
      } else {
        storedCode = await AsyncStorage.getItem('code');
      }
      if (storedCode) {
        const parsedCode = JSON.parse(storedCode);
        return parsedCode;
      }
    } catch (error) {
      console.error('Error fetching code data:', error);
    }
  };

  const rehydrateCode = async () => {
    const codeData = await fetchCodeData();
    if (codeData) {
      setCode(codeData);
    }
    setIsLoading(false);
  };

  useEffect(() => {
    rehydrateCode();
  }, []);

  useEffect(() => {
    if (code) {
      try {
        if (Platform.OS === 'web') {
          localStorage.setItem('code', JSON.stringify(code));
        } else {
          AsyncStorage.setItem('code', JSON.stringify(code));
        }
      } catch (error) {
        console.error('Error setting code:', error);
      }
    }
  }, [code]);

  const refreshCode = async () => {
    await rehydrateCode();
  };


  //For Dentist
  const fetchDentistData = async () => {
    getDentists();
    try {
      let storedDentist;
      if (Platform.OS === 'web') {
        storedDentist = localStorage.getItem('dentist');
      } else {
        storedDentist = await AsyncStorage.getItem('dentist');
      }
      if (storedDentist) {
        const parsedDentist = JSON.parse(storedDentist);
        return parsedDentist;
      }
    } catch (error) {
      console.error('Error fetching dentist data:', error);
    }
  };

  const rehydrateDentist = async () => {
    const dentistData = await fetchDentistData();
    if (dentistData) {
      setDentist(dentistData);
    }
  };

  useEffect(() => {
    rehydrateDentist();
  }, []);

  useEffect(() => {
    if (dentist) {
      try {
        if (Platform.OS === 'web') {
          localStorage.setItem('dentist', JSON.stringify(dentist));
        } else {
          AsyncStorage.setItem('dentist', JSON.stringify(dentist));
        }
      } catch (error) {
        console.error('Error setting dentist:', error);
      }
    }
  }, [dentist]);

  const refreshDentist = async () => {
    await rehydrateDentist();
  };

  //For Appointments
  const fetchAppointmentsData = async () => {
    const user = await fetchUserData();

    if (!user) {
      refreshAppointments();
      return;
    }
    const userID = user.id;
    const appointmentsData = await getAppointments({ userID });


 
    try {
      let storedAppointments;
      if (Platform.OS === 'web') {
        storedAppointments = localStorage.getItem('appointments');
      } else {
        storedAppointments = await AsyncStorage.getItem('appointments');
      }
      if (storedAppointments) {
        const parsedAppointments = JSON.parse(storedAppointments);
        return parsedAppointments;
      }
    } catch (error) {
      console.error('Error fetching appointments data:', error);
    }
  };

  const rehydrateAppointments = async () => {
    const appointmentsData = await fetchAppointmentsData();
    if (appointmentsData) {
      setAppointments(appointmentsData);
    }
  };

  useEffect(() => {
    rehydrateAppointments();
  }, []);

  useEffect(() => {
    if (appointments) {
      try {
        if (Platform.OS === 'web') {
          localStorage.setItem('appointments', JSON.stringify(appointments));
        } else {
          AsyncStorage.setItem('appointments', JSON.stringify(appointments));
        }
      } catch (error) {
        console.error('Error setting appointments:', error);
      }
    }
  }, [appointments]);

  const refreshAppointments = async () => {
    await rehydrateAppointments();
  };

  const login = (userData) => {
    setUser(userData);
    setIsLoggedIn(true);
  };

  const logout = async () => {
    setUser(null);
    setAppointments(null);
    setDentist(null);
    setCode(null);
    setIsLoggedIn(false);
    try {
      if (Platform.OS === 'web') {
        localStorage.clear();
      } else {
        await AsyncStorage.clear();
      }
    } catch (error) {
      console.error('Error clearing storage:', error);
    }
  };

  return (
    <GlobalContext.Provider value={{ isLoggedIn, user, code, dentist, appointments, isLoading, login, logout, refreshUser, refreshDentist, refreshAppointments, refreshCode }}>
      {children}
    </GlobalContext.Provider>
  );
};

export default GlobalProvider;

