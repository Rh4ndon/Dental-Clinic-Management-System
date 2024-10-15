import { View, Text, SafeAreaView, FlatList, RefreshControl, StyleSheet, TouchableOpacity, Platform, Alert } from 'react-native';
import React, { useContext, useEffect, useState } from 'react';
import { GlobalContext } from "../../context/GlobalProvider";
import DateTimePicker from '@react-native-community/datetimepicker';
import * as Request from '../../lib/PhpRequest';
import { Picker } from '@react-native-picker/picker';


const schedule = () => {

  const { appointments, user, isLoading, dentist, refreshUser, refreshDentist, refreshAppointments } = useContext(GlobalContext);
  const [data, setData] = useState([]);
  const [refreshing, setRefreshing] = React.useState(false);
  const [selectedDate, setSelectedDate] = useState('');
  const [selectedTime, setSelectedTime] = useState('');
  const [selectedDentist, setSelectedDentist] = useState(null);
  const [showDatePicker, setShowDatePicker] = useState(false);
  const [isSubmitting, setIsSubmitting] = useState(false);
 
  


  useEffect(() => {
    setData(appointments);
  }, [appointments]);


  const onRefresh = React.useCallback(() => {
    setRefreshing(true);
    refreshDentist();
    refreshUser();
    refreshAppointments().finally(() => setRefreshing(false));
  }, [refreshAppointments]);


  const renderItem = ({ item }) => {
    if(user?.id === item.client_id) {
      return (
        <View style={styles.item} key={`${item.appointment_id}`}>
          <View style={styles.row}>
            <Text style={styles.name}>{item.dentist_name}</Text>
            <Text style={styles.detail}>{item.time}</Text>
          </View>
          <View style={styles.row}>
            <Text style={styles.detail}>Email: {item.dentist_email}</Text>
          </View>
          <View style={styles.row}>
            <Text style={styles.detail}>Phone: {item.dentist_phone}</Text>
          </View>
          <View style={styles.row}>
            <Text style={styles.detail}>Date: {item.date}</Text>
            <View style={[styles.statusBadge, item.status === "0" ? styles.statusBadgeWarning : item.status === "1" ? styles.statusBadgeSuccess : styles.statusBadgeDanger]}>
              <Text style={[item.status === "0" ? styles.textBadgeWarning : item.status === "1" ? styles.textBadgeSuccess : styles.textBadgeDanger]}>
                {item.status === "0" ? 'Not Yet Done' : item.status === "1" ? 'Done' : 'Canceled'}
              </Text>
            </View>
          </View>
        </View>
      );
    }
    return null;
  };


  const handleDateChange = (date) => {
    setSelectedDate(date);

  };


  const handleTimeChange = (time) => {
    setSelectedTime(time);

  };


  const handleDentistChange = (itemValue) => {
    setSelectedDentist(itemValue);

  };




  const handleSubmit = async() => {
     // Prevent multiple submissions
      if (isSubmitting) return;
      setIsSubmitting(true);
      // Check that the user has input all the required details
      if (!selectedDate || !selectedTime || !selectedDentist ) {
          
        if (Platform.OS === 'web') {
          alert('Please fill in all the details');
        } else {
          Alert.alert('Please fill in all the details');
        }
        setIsSubmitting(false);
        return;
      }

      // Create a JSON payload for the PHP API
      const appointmentData = {
          date: selectedDate,
          time: selectedTime,
          dentist_id: selectedDentist,
          client_id: user.id
      };

      // Make a POST request to your PHP API
      try {
      
        await Request.createAppointment ({ appointmentData });     
        setIsSubmitting(false);
        onRefresh();
      } catch (error) {
          console.error('Error making request:', error);
          // Alerts
          if (Platform.OS === 'web') {
              alert('Error Something went wrong. Please try again later.', error)
          } else {
              Alert.alert('Error', 'Something went wrong. Please try again later.');
          }
          setIsSubmitting(false);
      } 
   
  };


  return (

    <SafeAreaView style={styles.container}>

      <Text style={styles.header}>Appointments</Text>

      <FlatList
        data={data}
        renderItem={renderItem}
        keyExtractor={item => item?.appointment_id?.toString() || ''}
        refreshControl={
          <RefreshControl refreshing={refreshing} onRefresh={onRefresh} />
        }
        contentContainerStyle={styles.list}
      />

      <View style={{flexDirection: 'column', justifyContent: 'space-around', alignItems: 'center', marginTop: 8,  backgroundColor: 'white', padding: 8, borderRadius: 8, shadowColor: '#000',
        shadowOffset: {
          width: 0,
          height: 2,
        },
        shadowOpacity: 0.25,
        shadowRadius: 3.84,
        elevation: 5,}}>
          <Text style={{fontSize: 16, fontWeight: 'bold'}}>Add Appointment</Text>
     
        <View style={{flexDirection: 'row', justifyContent: 'space-between', alignItems: 'center', marginTop: 8 }}>
          <Picker
        
          selectedValue={selectedTime}
          onValueChange={handleTimeChange}
          style={{width: 200, height: 50, alignSelf: 'center'}}>
            <Picker.Item label="Select Time" value={null} />
            <Picker.Item key={0} label="8:00 AM" value="8:00 AM" />
            <Picker.Item key={1} label="9:00 AM" value="9:00 AM" />
            <Picker.Item key={2} label="10:00 AM" value="10:00 AM" />
            <Picker.Item key={3} label="11:00 AM" value="11:00 AM" />
            <Picker.Item key={4} label="12:00 PM" value="12:00 PM" />
            <Picker.Item key={5} label="1:00 PM" value="1:00 PM" />
            <Picker.Item key={6} label="2:00 PM" value="2:00 PM" />
            <Picker.Item key={7} label="3:00 PM" value="3:00 PM" />
            <Picker.Item key={8} label="4:00 PM" value="4:00 PM" />
            <Picker.Item key={9} label="5:00 PM" value="5:00 PM" />
          </Picker>
          <TouchableOpacity onPress={() => setShowDatePicker(true)}>
            <Text style={{width: 100, height: 50, alignSelf: 'center', textAlign: 'center', textAlignVertical: 'center', fontSize: 16, color: '#333'}}>
              {selectedDate ? (new Date(selectedDate)).toLocaleDateString('en-US', {year: 'numeric', month: '2-digit', day: '2-digit'}) : 'Select Date'}
            </Text>
          </TouchableOpacity>
          {showDatePicker && <DateTimePicker
            value={selectedDate ? new Date(selectedDate) : new Date()}
            mode="date"
            onChange={(date) => {
              const newDate = new Date(date.nativeEvent.timestamp);
              if (isNaN(newDate.getTime())) {
                Alert.alert('Invalid Date', 'Please select a valid date');
              } else {
                handleDateChange(newDate);
                setShowDatePicker(false);
              }
            }}
            style={{width: 200, height: 50, alignSelf: 'center'}}
            onDismiss={() => setShowDatePicker(false)}
          />}

        
        </View>

        <View style={{flexDirection: 'row', justifyContent: 'space-between', alignItems: 'center', marginTop: 8}}>
          <Picker
            selectedValue={selectedDentist}
            onValueChange={handleDentistChange}
            style={{width: 200, height: 50, alignSelf: 'center'}}
          >
            {dentist.map((item) => (
              <Picker.Item label={item.name} value={item.id} key={item.id} />
            ))}
          </Picker>
          <TouchableOpacity style={{backgroundColor: 'black', padding: 16, borderRadius: 8, marginTop: 8, alignSelf: 'center'}} onPress={handleSubmit}>
            <Text style={{color: 'white'}}>Submit</Text>
          </TouchableOpacity>
        </View>

      </View>
    </SafeAreaView>
  );
};


export default schedule;

const styles = StyleSheet.create({
  container: {
    flex: 1,
    padding: 24,
    backgroundColor: '#f5f5f5',
  },
  list: {
    paddingVertical: 16,
  },
  item: {
    padding: 16,
    borderRadius: 8,
    backgroundColor: 'white',
    marginBottom: 16,
    shadowColor: '#000',
    shadowOffset: {
      width: 0,
      height: 2,
    },
    shadowOpacity: 0.25,
    shadowRadius: 3.84,
    elevation: 5,
  },
  row: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'space-between',
    marginBottom: 8
  },
  name: {
    fontSize: 18,
    fontWeight: 'bold',
  },
  detail: {
    fontSize: 16,
  },
  header: {
    fontSize: 24,
    fontWeight: 'bold',
    marginTop: 20,
    marginBottom: 15
  },
  statusBadge: {
    paddingHorizontal: 8,
    paddingVertical: 4,
    borderRadius: 24,
    fontWeight: 'bold',
    fontFamily: 'Poppins-Bold',
  },
  statusBadgeWarning: {
    backgroundColor: '#FFC107',
  },
  statusBadgeSuccess: {
    backgroundColor: '#34C759',
  },
  statusBadgeDanger: {
    backgroundColor: '#FF3B30',
  },
  textBadgeWarning: {
    color: 'black',
  },
  textBadgeSuccess: {
    color: 'white',
  },
  textBadgeDanger: {
    color: 'white',
  },

})


