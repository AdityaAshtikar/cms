import java.io.*;
import java.util.*;

class Main {

	public static void main(String args[]) {
		BufferedReader br = new BufferedReader(new InputStreamReader(System.in));
		ArrayList<Integer> nums = new ArrayList<Integer>();
		int i = 0;
		while(true) {
			if (nums.contains(42)) {
				nums.remove(nums.size() - 1);
				break;
			}
			try {
				nums.add(Integer.parseInt(br.readLine()));
				// System.out.println(nums[i]);
			} catch(IOException e) {
				System.out.println("Error: " + e);
			}
		}
		for (i=0; i<nums.size(); i++) {
			System.out.println(nums.get(i));
		}
	}
}