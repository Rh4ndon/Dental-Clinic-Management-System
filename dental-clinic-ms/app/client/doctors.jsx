import { StyleSheet, Text, View, FlatList, RefreshControl } from 'react-native'
import React ,{useContext} from 'react'
import { SafeAreaView } from 'react-native-safe-area-context'
import { GlobalContext } from "../../context/GlobalProvider";

const doctors = () => {
  const { dentist, isLoading , refreshDentist} = useContext(GlobalContext)
  const data = dentist
  const [refreshing, setRefreshing] = React.useState(false);

  const onRefresh = React.useCallback(() => {
    setRefreshing(true);
    refreshDentist().finally(() => setRefreshing(false));
  }, [refreshDentist]);


  const renderItem = ({ item }) => (
    <View style={styles.item}>
      <Text style={styles.name}>{item.name}</Text>
      <Text style={styles.detail}>{item.email}</Text>
      <Text style={styles.detail}>{item.phone}</Text>
      <Text style={styles.detail}>{item.schedule}</Text>
    </View>
  )

  return (
    <SafeAreaView style={styles.container}>
      <Text style={styles.header}>  Dentists Details and Schedule</Text>
      <FlatList
        data={data}
        renderItem={renderItem}
        keyExtractor={item => item.id.toString()}
        refreshControl={
          <RefreshControl refreshing={refreshing} onRefresh={onRefresh} />
        }
        contentContainerStyle={styles.list}
      />
    </SafeAreaView>
  )
}

export default doctors

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
  name: {
    fontSize: 18,
    fontWeight: 'bold',
    marginBottom: 8
  },
  detail: {
    fontSize: 16,
    marginBottom: 8
  },
  header: {
    fontSize: 24,
    fontWeight: 'bold',
    marginBottom: 16
  }
})

