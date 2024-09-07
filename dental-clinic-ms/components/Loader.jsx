import React from 'react';
import { Animated, Image, StyleSheet, View } from 'react-native';
import { SafeAreaView } from 'react-native-safe-area-context';

const LoadingAnimation = () => {
  const spinAnim = new Animated.Value(0);

  React.useEffect(() => {
    Animated.loop(
      Animated.timing(spinAnim, {
        toValue: 1,
        duration: 1000,
        useNativeDriver: true,
      }),
    ).start();
  }, [spinAnim]);

  return (
    <SafeAreaView style={styles.container}>
      <View style={styles.centerView}>
        <Animated.View
          style={{
            transform: [{ rotate: spinAnim.interpolate({ inputRange: [0, 1], outputRange: ['0deg', '360deg'] }) }],
          }}
        >
          <Image
            source={require('@/assets/images/loader.png')} // replace with your loader image
            style={styles.loader}
          />
        </Animated.View>
      </View>
    </SafeAreaView>
  );
};

export default LoadingAnimation

const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
  },
  centerView: {
    position: 'absolute',
    left: 0,
    right: 0,
    top: 0,
    bottom: 0,
    justifyContent: 'center',
    alignItems: 'center',
  },
  loader: {
    width: 50,
    height: 50,
  },
});

