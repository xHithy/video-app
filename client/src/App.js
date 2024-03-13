import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import LoginScreen from './screens/LoginScreen';
import RegisterScreen from './screens/RegisterScreen';

function App() {
   return (
      <Router>
         <Routes>
            <Route
               path='/login'
               element={<LoginScreen />}
            />
            <Route
               path='/register'
               element={<RegisterScreen />}
            />
         </Routes>
      </Router>
   );
}

export default App;
